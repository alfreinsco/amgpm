<?php

namespace App\Console\Commands;

use App\Jobs\SendBirthdayWishes;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class CheckBirthdayMembers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'birthday:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for members who have birthday tomorrow and send birthday wishes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking for members with birthday tomorrow...');
        
        try {
            // Ambil tanggal besok
            $tomorrow = Carbon::tomorrow();
            
            // Cari anggota yang berulang tahun besok (berdasarkan bulan dan tanggal saja)
            $birthdayMembers = User::whereNotNull('tanggal_lahir')
                ->whereNotNull('whatsapp')
                ->whereRaw('MONTH(tanggal_lahir) = ? AND DAY(tanggal_lahir) = ?', [
                    $tomorrow->month,
                    $tomorrow->day
                ])
                ->get();
            
            if ($birthdayMembers->isEmpty()) {
                $this->info('No members have birthday tomorrow.');
                Log::info('Birthday check completed - no birthdays tomorrow');
                return 0;
            }
            
            $this->info("Found {$birthdayMembers->count()} member(s) with birthday tomorrow:");
            
            foreach ($birthdayMembers as $member) {
                $age = Carbon::parse($member->tanggal_lahir)->age + 1;
                $this->line("- {$member->nama} (turning {$age}) - {$member->whatsapp}");
                
                // Dispatch job untuk mengirim ucapan
                SendBirthdayWishes::dispatch($member);
                
                Log::info('Birthday wish job dispatched', [
                    'user_id' => $member->id,
                    'nama' => $member->nama,
                    'tanggal_lahir' => $member->tanggal_lahir->format('Y-m-d'),
                    'whatsapp' => $member->whatsapp
                ]);
            }
            
            $this->info("Successfully dispatched {$birthdayMembers->count()} birthday wish job(s).");
            
            Log::info('Birthday check completed successfully', [
                'members_count' => $birthdayMembers->count(),
                'tomorrow_date' => $tomorrow->format('Y-m-d')
            ]);
            
            return 0;
            
        } catch (\Exception $e) {
            $this->error('Error occurred while checking birthdays: ' . $e->getMessage());
            
            Log::error('Birthday check failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return 1;
        }
    }
}