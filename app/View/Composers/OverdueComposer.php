<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\EbisManualInput;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class OverdueComposer
{
    public function compose(View $view)
    {
        $overdueCount = 0;
        $overdueOrders = collect();

        if (Auth::check()) {
            // Exclude Admin from overdue notifications
            if (Auth::user()->role === 'admin') {
                $view->with('overdueCount', 0);
                $view->with('overdueOrders', collect());
                return;
            }

            $today = Carbon::now()->startOfDay();

            $overdueOrders = EbisManualInput::whereHas('planning', function($q) {
                // Ensure we only count active orders (not already finished)
                // Adjust status check based on how "Done" is defined in your system.
                $q->whereNotIn('status_order', ['Success', 'Gagal', 'Cancel']);
            })
            ->get()
            ->filter(function ($item) use ($today) {
                // Determine if data has commitment_date
                if (!empty($item->data['commitment_date'])) {
                    
                    // Strict filtering: Only show if MATCHES auth()->id()
                    if (isset($item->data['commitment_updated_by']) && $item->data['commitment_updated_by'] != Auth::id()) {
                        return false;
                    }

                    try {
                         // Parse the commitment date
                        $commitmentDate = Carbon::parse($item->data['commitment_date'])->startOfDay();
                        // If commitment date is in the past (lt = less than today), it's overdue
                        return $commitmentDate->lt($today);
                    } catch (\Exception $e) {
                        return false;
                    }
                }
                return false;
            });

            $overdueCount = $overdueOrders->count();
        }

        $view->with('overdueCount', $overdueCount);
        $view->with('overdueOrders', $overdueOrders);
    }
}
