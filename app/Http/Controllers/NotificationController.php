<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EbisManualInput;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        // Admins should not see notifications
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Only for user_optima and relevant roles
        // Filter orders where commitment date < today AND status is NOT finished
        
        $today = Carbon::now()->startOfDay();

        // Check if role is allowed (optional, middleware handles basic auth)
        // Adjust logic based on exact requirements for "user_optima"
        
        $overdueOrders = EbisManualInput::whereHas('planning', function($q) {
                $q->whereNotIn('status_order', ['Success', 'Gagal', 'Cancel']);
            })
            ->get()
            ->filter(function ($item) use ($today) {
                // Determine if data has commitment_date
                if (!empty($item->data['commitment_date'])) {
                    
                    // Check if current user is the one who set the commitment (if recorded)
                    // If 'commitment_updated_by' is set, only show to that user.
                    // If NOT set, maybe show to all? Or none? User request implies specificity.
                    // Let's assume strict filtering: Only show if MATCHES auth()->id()
                    if (isset($item->data['commitment_updated_by']) && $item->data['commitment_updated_by'] != Auth::id()) {
                        return false;
                    }

                    try {
                        $commitmentDate = Carbon::parse($item->data['commitment_date'])->startOfDay();
                        return $commitmentDate->lt($today);
                    } catch (\Exception $e) {
                        return false;
                    }
                }
                return false;
            });

        return view('notifications.index', compact('overdueOrders'));
    }
}
