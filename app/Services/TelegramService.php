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

    /**
     * Kirim pesan teks ke Telegram Bot API.
     */
    public function sendMessage(string $text, ?string $chatId = null): bool
    {
        if (empty($this->botToken) || empty($chatId ?? $this->chatId)) {
            Log::warning('Telegram: bot_token atau chat_id belum diset.');
            return false;
        }

        try {
            $response = Http::post("https://api.telegram.org/bot{$this->botToken}/sendMessage", [
                'chat_id'    => $chatId ?? $this->chatId,
                'text'       => $text,
                'parse_mode' => 'HTML',
            ]);

            if ($response->failed()) {
                Log::error('Telegram sendMessage gagal', [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);
                return false;
            }

            return true;
        } catch (\Exception $e) {
            Log::error('Telegram sendMessage exception', ['error' => $e->getMessage()]);
            return false;
        }
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
        if ($keterangan) {
            $text .= "📝 <b>Keterangan:</b> {$keterangan}\n";
        }

        // Ambil riwayat progress dari log
        $planning = $order->planning;
        if ($planning) {
            $logs = EbisPlanningProgressLog::where('ebis_planning_order_id', $planning->id)
                ->with('user')
                ->orderBy('created_at', 'asc')
                ->get();

            if ($logs->isNotEmpty()) {
                $text .= "\n📅 <b>Riwayat Progress:</b>\n";
                foreach ($logs as $i => $log) {
                    $no = $i + 1;
                    $date = $log->created_at->format('d M Y');
                    $user = $log->user->name ?? 'System';
                    $isLast = ($i === $logs->count() - 1);
                    $marker = $isLast ? ' ← <i>Sekarang</i>' : '';
                    $text .= "{$no}. <b>{$log->progres}</b> — {$date} ({$user}){$marker}\n";
                }
            }
        }

        $text .= "\n🕐 <b>Update:</b> " . now()->format('d M Y H:i') . " WIB";
        $text .= "\n👷 <b>Oleh:</b> " . (auth()->user()->name ?? 'Unknown');

        $this->sendMessage($text);
    }
}
