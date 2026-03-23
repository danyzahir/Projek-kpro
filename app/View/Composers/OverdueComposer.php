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

            $todayStr = Carbon::now()->startOfDay()->format('Y-m-d');

            $userId = Auth::id();

            $overdueOrders = EbisManualInput::whereHas('planning', function($q) {
                // Ensure we only count active orders (not already finished)
                $q->whereNotIn('status_order', ['Success', 'Gagal', 'Cancel']);
            })
            ->whereNotNull('data')
            ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(data, '$.commitment_date')) IS NOT NULL")
            ->whereRaw("STR_TO_DATE(JSON_UNQUOTE(JSON_EXTRACT(data, '$.commitment_date')), '%Y-%m-%d') < ?", [$todayStr])
            ->where(function($q) use ($userId) {
                // Strict filtering: Only show if MATCHES auth()->id() or if it's null (not set yet)
                $q->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(data, '$.commitment_updated_by')) IS NULL")
                  ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(data, '$.commitment_updated_by')) = ?", [$userId]);
            })
            // Tambahkan whereNotIn progres agar selaras dengan dashboard
            ->whereNotIn('progres', ['GOLIVE', 'PS', 'UJI TERIMA', 'REKON'])
            ->get();

            $overdueCount = $overdueOrders->count();
        }

        $view->with('overdueCount', $overdueCount);
        $view->with('overdueOrders', $overdueOrders);
    }
}
