<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EbisManualInput;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\EbisPlanningOrder;
use App\Models\EbisPlanningProgressLog;

class AdminController extends Controller
{
    public function dashboard()
    {
        // --- 1. STATS CARDS ---

        // Total Deployment (This Month)
        $totalDeployment = EbisManualInput::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
        
        // Total Deployment (Last Month) - for comparison
        $lastMonthDeployment = EbisManualInput::whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->count();

        // Calculate Trend (Simple % change)
        $trendPercentage = 0;
        if ($lastMonthDeployment > 0) {
            $trendPercentage = (($totalDeployment - $lastMonthDeployment) / $lastMonthDeployment) * 100;
        }

        // Success Rate (All Time)
        $totalAll = EbisManualInput::count();
        $totalSuccess = EbisManualInput::whereHas('planning', function ($q) {
            $q->where('status_order', 'Success');
        })->count();
        $successRate = $totalAll > 0 ? ($totalSuccess / $totalAll) * 100 : 0;

        // Total On Process (Active but not valid pending or success)
        // Based on status-badge: progress, survey, inisiasi, validasi, drm, matdev, instalasi
        $totalOnProcess = EbisManualInput::whereHas('planning', function ($q) {
            $q->where(function($query) {
                $query->where('status_order', 'LIKE', '%Progress%')
                      ->orWhere('status_order', 'LIKE', '%Survey%')
                      ->orWhere('status_order', 'LIKE', '%Inisiasi%')
                      ->orWhere('status_order', 'LIKE', '%Validasi%')
                      ->orWhere('status_order', 'LIKE', '%Drm%')
                      ->orWhere('status_order', 'LIKE', '%Matdev%')
                      ->orWhere('status_order', 'LIKE', '%Instalasi%');
            });
        })->count();

        // Pending Review (Status = Pending / Wait)
        // Using 'Pending' or 'Wait'
        $pendingReview = EbisManualInput::whereHas('planning', function ($q) {
            $q->where(function($query) {
                $query->where('status_order', 'LIKE', '%Pending%')
                      ->orWhere('status_order', 'LIKE', '%Wait%');
            });
        })->count();

        // Issues Reported (Status = Kendala or Gagal or Cancel)
        $issuesReported = EbisManualInput::whereHas('planning', function ($q) {
            $q->whereIn('status_order', ['Kendala', 'Gagal', 'Cancel']);
        })->count();


        // D. Failure Rate
        $totalFailed = EbisManualInput::whereHas('planning', function ($q) {
             $q->whereIn('status_order', ['Gagal', 'Cancel']);
        })->count();
        $failureRate = $totalAll > 0 ? ($totalFailed / $totalAll) * 100 : 0;


        // --- 2. CHARTS DATA ---

        // Chart 1: Deployment Trend (Last 7 Days)
        $sevenDaysAgo = Carbon::now()->subDays(6)->startOfDay();
        $trendData = EbisManualInput::select(
                DB::raw('DATE(created_at) as date'), 
                DB::raw('count(*) as total')
            )
            ->where('created_at', '>=', $sevenDaysAgo)
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // Prepare chart labels (Mon, Tue, etc.) and values
        $trendLabels = [];
        $trendValues = [];
        
        // Fill in missing days with 0
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $dayName = Carbon::now()->subDays($i)->locale('id')->dayName; // Requires Carbon locale set
            
            $record = $trendData->firstWhere('date', $date);
            
            $trendLabels[] = $dayName;
            $trendValues[] = $record ? $record->total : 0;
        }

        // Chart 2: Status Distribution
        // We need to join with planning to group by status_order
        $statusDistRaw = EbisManualInput::select('ebis_planning_orders.status_order as status_label', DB::raw('count(*) as total'))
            ->join('ebis_planning_orders', 'ebis_manual_inputs.star_click_id', '=', 'ebis_planning_orders.star_click_id')
            ->groupBy('status_label')
            ->pluck('total', 'status_label');

        // Aggregate 'On Process' statuses
        $onProcessCount = 0;
        $onProcessKeywords = ['Progress', 'Survey', 'Inisiasi', 'Validasi', 'Drm', 'Matdev', 'Instalasi'];
        
        foreach ($statusDistRaw as $label => $count) {
            foreach ($onProcessKeywords as $keyword) {
                if (stripos($label, $keyword) !== false) {
                    $onProcessCount += $count;
                    break; // Stop checking other keywords for this label
                }
            }
        }

        $statusDist = [
            'Success' => $statusDistRaw['Success'] ?? 0,
            'On Process' => $onProcessCount,
            'Pending' => $statusDistRaw['Pending'] ?? 0,
            'Issues' => ($statusDistRaw['Kendala'] ?? 0) + ($statusDistRaw['Gagal'] ?? 0) + ($statusDistRaw['Cancel'] ?? 0)
        ];

        
        // --- 3. LIVE TABLE (Latest 5) ---
        $recentDeployments = EbisManualInput::with('planning')->latest()->take(5)->get();


        // --- 4. WAITING USERS ---
        $waitingUsers = User::where('role', 'waiting')->take(5)->get();


        // --- 5. TOP PARTNER PERFORMANCE ---
        // Calculate success rate per mitra
        // We need a complex query or collection processing here. 
        // Let's take top 3 active mitras
        $topMitras = EbisManualInput::select('nama_mitra', DB::raw('count(*) as total_jobs'))
            ->whereNotNull('nama_mitra')
            ->where('nama_mitra', '!=', '')
            ->groupBy('nama_mitra')
            ->orderByDesc('total_jobs')
            ->take(3)
            ->get()
            ->map(function($mitra) {
                // Get success count for this mitra
                $successCount = EbisManualInput::where('nama_mitra', $mitra->nama_mitra)
                    ->whereHas('planning', function ($q) {
                        $q->where('status_order', 'LIKE', '%Success%');
                    })
                    ->count();
                
                $rate = $mitra->total_jobs > 0 ? ($successCount / $mitra->total_jobs) * 100 : 0;
                
                return [
                    'name' => $mitra->nama_mitra,
                    'rate' => round($rate, 1),
                    'total' => $mitra->total_jobs
                ];
            });
        // --- 6. LIVE PROGRESS LOGS (Live Tracking) ---
        $liveTracking = EbisPlanningProgressLog::with(['user', 'planning.manualInput'])
            ->latest()
            ->take(10)
            ->get();

        // --- 7. OVERDUE COMMITMENTS ---
        $today = Carbon::now()->startOfDay();
        $overdueCommitments = EbisManualInput::with('planning')
            ->whereHas('planning', function ($q) {
                $q->whereNotIn('status_order', ['Success', 'Gagal', 'Cancel']);
            })
            ->get()
            ->filter(function ($item) use ($today) {
                if (!empty($item->data['commitment_date'])) {
                    try {
                        return Carbon::parse($item->data['commitment_date'])->startOfDay()->lt($today);
                    } catch (\Exception $e) {
                        return false;
                    }
                }
                return false;
            })
            ->map(function ($item) {
                // Ambil nama user yang set commitment dari tabel users
                $userId = $item->data['commitment_updated_by'] ?? null;
                $userName = $userId
                    ? (\App\Models\User::find($userId)?->name ?? 'Unknown')
                    : 'Unknown';

                return [
                    'star_click_id'   => $item->star_click_id,
                    'nama_customer'   => $item->nama_customer,
                    'commitment_date' => $item->data['commitment_date'],
                    'updated_by'      => $userName,
                    'days_overdue'    => (int) Carbon::parse($item->data['commitment_date'])->startOfDay()->diffInDays(now()->startOfDay()),
                    'status'          => optional($item->planning)->status_order ?? '-',
                ];
            })
            ->sortByDesc('days_overdue')
            ->values();

        return view('admin.dashboard', compact(
            'totalDeployment',
            'trendPercentage',
            'successRate',
            'failureRate',
            'totalOnProcess',
            'pendingReview',
            'issuesReported',
            'trendLabels',
            'trendValues',
            'statusDist',
            'recentDeployments',
            'waitingUsers',
            'topMitras',
            'liveTracking',
            'overdueCommitments'
        ));
    }
    public function getEnterpriseStats()
    {
        // ...

        // B. Aging Analysis (Distribution of active deployments)
        // We need raw days diff for active orders
        $activeOrders = EbisManualInput::whereHas('planning', function ($q) {
                $q->whereNotIn('status_order', ['Success', 'Gagal', 'Cancel']);
            })
            ->whereNotNull('created_at') // Added safety
            ->select('created_at')
            ->get();

        $aging = [
            '0-3' => 0,
            '4-7' => 0,
            '8-14' => 0,
            '>14' => 0
        ];

        foreach ($activeOrders as $order) {
            if (!$order->created_at) continue; // Safety check
            $days = $order->created_at->diffInDays($now);
            if ($days <= 3) $aging['0-3']++;
            elseif ($days <= 7) $aging['4-7']++;
            elseif ($days <= 14) $aging['8-14']++;
            else $aging['>14']++;
        }

        // C. KPI Progress (Monthly)
        $kpiTarget = 100; // Hardcoded target
        $kpiRealization = $totalDeployment; // Assuming total deployment this month is the realization
        // Or strictly 'Success' this month? Usually deployment target involves successes. 
        // Let's use Total Deployment for now as "Production", or Success if requested strictly.
        // User asked "target bulanan vs realisasi". Let's use Success for a stricter KPI.
        $monthlySuccess = EbisManualInput::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->whereHas('planning', function ($q) {
                $q->where('status_order', 'Success');
            })->count();
        
        $kpiPercentage = $kpiTarget > 0 ? ($monthlySuccess / $kpiTarget) * 100 : 0;


        // D. Failure Rate
        $totalFailed = EbisManualInput::whereHas('planning', function ($q) {
             $q->whereIn('status_order', ['Gagal', 'Cancel']);
        })->count();
        $failureRate = $totalAll > 0 ? ($totalFailed / $totalAll) * 100 : 0;


        // --- 4. DETAILS ---

        // Recent Deployments
        $recentDeployments = EbisManualInput::with('planning')
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($deploy) {
                return [
                    'time_ago' => $deploy->created_at->diffForHumans(),
                    'star_click_id' => $deploy->star_click_id,
                    'sto' => strtoupper($deploy->sto),
                    'mitra' => $deploy->nama_mitra,
                    'status' => optional($deploy->planning)->status_order ?? 'Unknown',
                    'status_class' => $this->getStatusClass(optional($deploy->planning)->status_order ?? 'Unknown')
                ];
            });

        // Top Partners
        $topMitras = EbisManualInput::select('nama_mitra', DB::raw('count(*) as total_jobs'))
            ->whereNotNull('nama_mitra')
            ->where('nama_mitra', '!=', '')
            ->groupBy('nama_mitra')
            ->orderByDesc('total_jobs')
            ->take(3)
            ->get()
            ->map(function($mitra) {
                $checkSuccess = EbisManualInput::where('nama_mitra', $mitra->nama_mitra)
                    ->whereHas('planning', function ($q) {
                        $q->where('status_order', 'LIKE', '%Success%');
                    })
                    ->count();
                $rate = $mitra->total_jobs > 0 ? ($checkSuccess / $mitra->total_jobs) * 100 : 0;
                return [
                    'name' => $mitra->nama_mitra,
                    'rate' => round($rate, 1),
                    'total' => $mitra->total_jobs
                ];
            });

        // Status Dist (Simplified for JSON)
        $statusDist = [
            'Success' => $totalSuccess,
            'On Process' => $totalOnProcess,
            'Pending' => $pendingReview,
            'Issues' => $issuesReported
        ];

        return response()->json([
            // Basic
            'totalDeployment' => number_format($totalDeployment),
            'trendPercentage' => number_format($trendPercentage, 1),
            'isTrendPositive' => $trendPercentage >= 0,
            'successRate' => number_format($successRate, 1),
            'totalOnProcess' => number_format($totalOnProcess),
            'pendingReview' => number_format($pendingReview),
            'issuesReported' => number_format($issuesReported),
            // Enterprise
            'overSLACount' => $overSLACount,
            'aging' => $aging,
            'kpi' => [
                'target' => $kpiTarget,
                'realization' => $monthlySuccess,
                'percentage' => round($kpiPercentage, 1)
            ],
            'failureRate' => round($failureRate, 1),
            // Lists
            'recentDeployments' => $recentDeployments,
            'statusDist' => array_values($statusDist),
            'topMitras' => $topMitras
        ]);
    }
    public function getRealtimeStats()
    {
        // 1. Basic Counts
        $totalDeployment = EbisManualInput::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        $lastMonthDeployment = EbisManualInput::whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->count();

        $trendPercentage = 0;
        if ($lastMonthDeployment > 0) {
            $trendPercentage = (($totalDeployment - $lastMonthDeployment) / $lastMonthDeployment) * 100;
        }

        $totalAll = EbisManualInput::count();
        $totalSuccess = EbisManualInput::whereHas('planning', function ($q) {
            $q->where('status_order', 'Success');
        })->count();
        $successRate = $totalAll > 0 ? ($totalSuccess / $totalAll) * 100 : 0;

        $totalOnProcess = EbisManualInput::whereHas('planning', function ($q) {
            $q->where(function ($query) {
                $query->where('status_order', 'LIKE', '%Progress%')
                    ->orWhere('status_order', 'LIKE', '%Survey%')
                    ->orWhere('status_order', 'LIKE', '%Inisiasi%')
                    ->orWhere('status_order', 'LIKE', '%Validasi%')
                    ->orWhere('status_order', 'LIKE', '%Drm%')
                    ->orWhere('status_order', 'LIKE', '%Matdev%')
                    ->orWhere('status_order', 'LIKE', '%Instalasi%');
            });
        })->count();

        $pendingReview = EbisManualInput::whereHas('planning', function ($q) {
            $q->where(function ($query) {
                $query->where('status_order', 'LIKE', '%Pending%')
                    ->orWhere('status_order', 'LIKE', '%Wait%');
            });
        })->count();

        $issuesReported = EbisManualInput::whereHas('planning', function ($q) {
            $q->whereIn('status_order', ['Kendala', 'Gagal', 'Cancel']);
        })->count();

        // 2. Recent Deployments (Live Table)
        $recentDeployments = EbisManualInput::with('planning')
            ->latest()
            ->take(10) // Show last 10
            ->get()
            ->map(function ($deploy) {
                return [
                    'time_ago' => $deploy->created_at->diffForHumans(),
                    'star_click_id' => $deploy->star_click_id,
                    'sto' => strtoupper($deploy->sto),
                    'mitra' => $deploy->nama_mitra,
                    'status' => optional($deploy->planning)->status_order ?? 'Unknown',
                    'status_class' => $this->getStatusClass(optional($deploy->planning)->status_order ?? 'Unknown')
                ];
            });

        // 3. Status Distribution (Chart)
        $statusDistRaw = EbisManualInput::select('ebis_planning_orders.status_order as status_label', DB::raw('count(*) as total'))
            ->join('ebis_planning_orders', 'ebis_manual_inputs.star_click_id', '=', 'ebis_planning_orders.star_click_id')
            ->groupBy('status_label')
            ->pluck('total', 'status_label');

        // Aggregate 'On Process' statuses
        $onProcessCount = 0;
        $onProcessKeywords = ['Progress', 'Survey', 'Inisiasi', 'Validasi', 'Drm', 'Matdev', 'Instalasi'];
        
        foreach ($statusDistRaw as $label => $count) {
            foreach ($onProcessKeywords as $keyword) {
                if (stripos($label, $keyword) !== false) {
                    $onProcessCount += $count;
                    break;
                }
            }
        }

        $statusDist = [
            'Success' => $statusDistRaw['Success'] ?? 0,
            'On Process' => $onProcessCount, // Added this
            'Pending' => $statusDistRaw['Pending'] ?? 0,
            'Issues' => ($statusDistRaw['Kendala'] ?? 0) + ($statusDistRaw['Gagal'] ?? 0) + ($statusDistRaw['Cancel'] ?? 0)
        ];

        // 4. Waiting Users (Optional, if we want to update this too, but for now user focused on partners)
        // ...

        // 5. Top Partner Performance
        $topMitras = EbisManualInput::select('nama_mitra', DB::raw('count(*) as total_jobs'))
            ->whereNotNull('nama_mitra')
            ->where('nama_mitra', '!=', '')
            ->groupBy('nama_mitra')
            ->orderByDesc('total_jobs')
            ->take(3)
            ->get()
            ->map(function($mitra) {
                $successCount = EbisManualInput::where('nama_mitra', $mitra->nama_mitra)
                    ->whereHas('planning', function ($q) {
                        $q->where('status_order', 'LIKE', '%Success%');
                    })
                    ->count();
                
                $rate = $mitra->total_jobs > 0 ? ($successCount / $mitra->total_jobs) * 100 : 0;
                
                return [
                    'name' => $mitra->nama_mitra,
                    'rate' => round($rate, 1),
                    'total' => $mitra->total_jobs
                ];
            });

        return response()->json([
            'totalDeployment' => number_format($totalDeployment),
            'trendPercentage' => number_format($trendPercentage, 1),
            'isTrendPositive' => $trendPercentage >= 0,
            'successRate' => number_format($successRate, 1),
            'totalOnProcess' => number_format($totalOnProcess),
            'pendingReview' => number_format($pendingReview),
            'issuesReported' => number_format($issuesReported),
            'recentDeployments' => $recentDeployments,
            'statusDist' => array_values($statusDist),
            'topMitras' => $topMitras
        ]);
    }

    public function getLiveTracking()
    {
        $logs = EbisPlanningProgressLog::with(['user', 'planning'])
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($log) {
                return [
                    'user_name'     => $log->user->name ?? 'System',
                    'user_initials' => strtoupper(substr($log->user->name ?? '?', 0, 2)),
                    'star_click_id' => $log->planning->star_click_id ?? 'N/A',
                    'progres'       => $log->progres,
                    'time_ago'      => $log->created_at->diffForHumans(null, true, true),
                    'commitment_date' => isset($log->data['commitment_date'])
                        ? \Carbon\Carbon::parse($log->data['commitment_date'])->format('d M')
                        : null,
                ];
            });

        return response()->json($logs);
    }

    public function getTrendData(Request $request)
    {
        $filter = $request->get('filter', 'daily'); // daily, weekly, monthly
        $labels = [];
        $values = [];

        if ($filter === 'monthly') {
            // Last 6 months
            for ($i = 5; $i >= 0; $i--) {
                $date = Carbon::now()->subMonths($i);
                $labels[] = $date->locale('id')->monthName;
                
                $values[] = EbisManualInput::whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->count();
            }
        } elseif ($filter === 'weekly') {
            // Last 4 weeks
            for ($i = 3; $i >= 0; $i--) {
                $start = Carbon::now()->subWeeks($i)->startOfWeek();
                $end = Carbon::now()->subWeeks($i)->endOfWeek();
                $labels[] = "W" . ($i + 1) . " (" . $start->format('d/m') . ")";
                
                $values[] = EbisManualInput::whereBetween('created_at', [$start, $end])->count();
            }
        } else {
            // Default: Daily (Last 7 days)
            for ($i = 6; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i);
                $labels[] = $date->locale('id')->dayName;
                
                $values[] = EbisManualInput::whereDate('created_at', $date->format('Y-m-d'))->count();
            }
        }

        return response()->json([
            'labels' => $labels,
            'values' => $values
        ]);
    }

    private function getStatusClass($status)
    {
        if (stripos($status, 'Success') !== false) return 'bg-green-100 text-green-800';
        if (stripos($status, 'Pending') !== false || stripos($status, 'Wait') !== false) return 'bg-yellow-100 text-yellow-800';
        if (stripos($status, 'Kendala') !== false || stripos($status, 'Gagal') !== false) return 'bg-red-100 text-red-800';
        return 'bg-blue-100 text-blue-800'; // Default / Progress
    }
}
