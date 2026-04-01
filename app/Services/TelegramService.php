<?php

namespace App\Services;

use App\Models\EbisManualInput;
use App\Models\EbisPlanningProgressLog;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramService
{
    protected string $botToken;
    protected string $chatId;

    public function __construct()
    {
        $this->botToken = config('services.telegram.bot_token', '');
        $this->chatId   = config('services.telegram.chat_id', '');
    }

    public function sendMessage(string $text, ?string $chatId = null): bool
    {
        if (empty($this->botToken) || empty($chatId ?? $this->chatId)) {
            Log::warning('Telegram: bot_token atau chat_id belum diset.');
            return false;
        }

        // 1. Simpan pesan ke antrian Database agar UI web bisa langsung selesai (Loading 0ms)
        dispatch(new \App\Jobs\SendTelegramNotification($text, $chatId ?? $this->chatId));

        // 2. Trik Sulap: Paksa sistem operasi Windows untuk diam-diam membuka "Pekerja Kirim"
        // secara gaib di belakang layar yang tugasnya mengirim 1 antrian telegram lalu mati sendiri.
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $artisan = base_path('artisan');
            pclose(popen("start /B php \"$artisan\" queue:work --once > NUL 2>&1", "r"));
        }

        return true;
    }

    /**
     * Notifikasi saat order baru dibuat.
     */
    public function notifyNewOrder(EbisManualInput $order): void
    {
        $text  = "🆕 <b>ORDER BARU DIBUAT</b>\n";
        $text .= "━━━━━━━━━━━━━━━━━━━━\n\n";
        $text .= "📌 <b>Star Click ID:</b> {$order->star_click_id}\n";
        $text .= "👤 <b>Customer:</b> {$order->nama_customer}\n";
        $text .= "🏢 <b>STO:</b> " . strtoupper($order->sto) . " · <b>Datel:</b> {$order->datel}\n";
        $text .= "🔧 <b>Mitra:</b> {$order->nama_mitra}\n";

        if ($order->alamat_pelanggan) {
            $text .= "📍 <b>Alamat:</b> {$order->alamat_pelanggan}\n";
        }
        if ($order->telepon_pelanggan) {
            $text .= "📞 <b>Telepon:</b> {$order->telepon_pelanggan}\n";
        }

        $text .= "\n🕐 <b>Dibuat:</b> " . now()->format('d M Y H:i') . " WIB";

        $this->sendMessage($text);
    }

    /**
     * Notifikasi saat progress di-update, termasuk riwayat lengkap.
     */
    public function notifyProgressUpdate(EbisManualInput $order, string $progres, ?string $keterangan = null): void
    {
        $text  = "📋 <b>UPDATE PROGRESS DEPLOYMENT</b>\n";
        $text .= "━━━━━━━━━━━━━━━━━━━━\n\n";
        $text .= "📌 <b>Star Click ID:</b> {$order->star_click_id}\n";
        $text .= "👤 <b>Customer:</b> {$order->nama_customer}\n";
        $text .= "🏢 <b>STO:</b> " . strtoupper($order->sto) . " · <b>Datel:</b> {$order->datel}\n";
        $text .= "🔧 <b>Mitra:</b> {$order->nama_mitra}\n\n";

        $text .= "📊 <b>Progress:</b> {$progres}\n";

        // Ambil riwayat progress dari log
        $planning = $order->planning;
        if ($planning) {
            $logs = $planning->logs()->with('user')->orderBy('created_at', 'asc')->get();
            if ($logs->isNotEmpty()) {
                $text .= "\n📅 <b>Riwayat Progress:</b>\n";
                foreach ($logs as $i => $log) {
                    $no = $i + 1;
                    $date = $log->created_at->format('d M Y');
                    $user = $log->user->name ?? 'System';
                    $isLast = ($i === $logs->count() - 1);
                    $marker = $isLast ? ' ← Sekarang' : '';
                    $text .= "{$no}. {$log->progres} — {$date} ({$user}){$marker}\n";
                }
            }
        }

        $text .= "\n🕐 <b>Update:</b> " . now()->format('d M Y H:i') . " WIB";
        $text .= "\n👷 <b>Oleh:</b> " . (auth()->user()->name ?? 'Unknown');

        $this->sendMessage($text);
    }

    /**
     * Laporan Harian: Semua progress hari ini.
     */
    public function sendDailyReport(): void
    {
        // Ambil semua log hari ini
        $logs = EbisPlanningProgressLog::with(['planning.manualInput', 'user'])
            ->whereDate('created_at', now()->format('Y-m-d'))
            ->orderBy('created_at', 'asc')
            ->get();

        $dateStr = now()->format('d M Y');

        if ($logs->isEmpty()) {
            $text  = "📅 <b>LAPORAN HARIAN DEPLOYMENT</b>\n";
            $text .= "━━━━━━━━━━━━━━━━━━━━\n\n";
            $text .= "Hari/Tgl: <b>{$dateStr}</b>\n\n";
            $text .= "<i>Tidak ada update progress hari ini.</i> 📭\n";
            
            $this->sendMessage($text);
            return;
        }

        $text  = "📅 <b>LAPORAN HARIAN DEPLOYMENT</b>\n";
        $text .= "━━━━━━━━━━━━━━━━━━━━\n\n";
        $text .= "Hari/Tgl: <b>{$dateStr}</b>\n";
        $text .= "Total Update: <b>{$logs->count()} Aktivitas</b>\n\n";

        // Grouping logs (optional) or just list them sequentially
        foreach ($logs as $i => $log) {
            $no = $i + 1;
            $order = $log->planning->manualInput ?? null;
            
            $customer = $order ? $order->nama_customer : 'Unknown Customer';
            $starclick = $order ? $order->star_click_id : '-';
            
            $user = $log->user->name ?? 'System';
            $time = $log->created_at->format('H:i');
            $progres = $log->progres;

            $text .= "<b>{$no}. {$customer}</b> ({$starclick})\n";
            $text .= "   👉 <b>{$progres}</b> pada {$time} (oleh <i>{$user}</i>)\n\n";
        }

        $text .= "Semangat terus rekan-rekan! 🚀";

        $this->sendMessage($text);
    }
}
