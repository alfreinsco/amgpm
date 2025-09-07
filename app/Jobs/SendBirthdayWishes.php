<?php

namespace App\Jobs;

use App\Http\Controllers\WhatsappController;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class SendBirthdayWishes implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $gatewayUrl;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->gatewayUrl = config('app.wa_gateway_url', 'http://localhost:5001');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // Format nomor WhatsApp
            $phoneNumber = formatPhoneNumber($this->user->whatsapp);

            if (!$phoneNumber) {
                Log::warning('User tidak memiliki nomor WhatsApp yang valid', ['user_id' => $this->user->id]);
                return;
            }

            // Hitung umur
            $age = Carbon::parse($this->user->tanggal_lahir)->age + 1; // +1 karena besok ulang tahun

            // Template pesan ucapan ulang tahun
            $message = $this->getBirthdayMessage($age);

            // Kirim pesan melalui WhatsApp Gateway
            $response = Http::post($this->gatewayUrl . '/message/send-text', [
                'session' => 'amgpm',
                'to' => $phoneNumber,
                'text' => $message,
                'is_group' => false
            ]);

            if ($response->successful()) {
                Log::info('Ucapan ulang tahun berhasil dikirim', [
                    'user_id' => $this->user->id,
                    'nama' => $this->user->nama,
                    'phone' => $phoneNumber
                ]);
            } else {
                Log::error('Gagal mengirim ucapan ulang tahun', [
                    'user_id' => $this->user->id,
                    'nama' => $this->user->nama,
                    'phone' => $phoneNumber,
                    'response_status' => $response->status(),
                    'response_body' => $response->body()
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error saat mengirim ucapan ulang tahun', [
                'user_id' => $this->user->id,
                'nama' => $this->user->nama,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Generate birthday message template
     */
    private function getBirthdayMessage(int $age): string
    {
        $tomorrow = Carbon::tomorrow()->format('d F Y');

        return "🎉 *Selamat Ulang Tahun ke-{$age}* 🎉\n\n" .
               "Halo {$this->user->nama},\n\n" .
               "Kami dari Angkatan Muda Gereja Protestant Maluku (AMGPM) mengucapkan selamat ulang tahun yang ke-{$age} pada tanggal {$tomorrow}.\n\n" .
               "Kiranya Tuhan Yesus senantiasa memberkati hidup Anda dengan kesehatan, kebahagiaan, dan berkat yang melimpah.\n\n" .
               "📅 *Pemberitahuan Penting:*\n" .
               "Besok (tanggal {$tomorrow}) pengurus AMGPM akan datang ke rumah Anda untuk memberikan ucapan selamat secara langsung dan melayani Anda.\n\n" .
               "Mohon persiapkan diri dan jika ada perubahan jadwal atau alamat, silakan hubungi kami.\n\n" .
               "Tuhan memberkati! 🙏\n\n" .
               "_Salam,_\n" .
               "*Pengurus AMGPM*";
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error('SendBirthdayWishes job failed', [
            'user_id' => $this->user->id,
            'nama' => $this->user->nama,
            'exception' => $exception->getMessage(),
            'trace' => $exception->getTraceAsString()
        ]);
    }
}
