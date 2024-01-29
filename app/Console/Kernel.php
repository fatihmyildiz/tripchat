<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
{
    $bugun = now()->format('Y-m-d');

    // İlk işlem
    $schedule->call(function () use ($bugun) {
        Reservation::where('checkout_date', '<', $bugun)
            ->whereIn('status', [0, 1]) // Status 0 veya 1 olanları güncelle
            ->update(['status' => 4]);
    })->dailyAt('14:00');

    $schedule->call(function () {
        // Bugünün tarihini today.php config dosyasına kaydet
        Config::set('today.bugun', now()->format('Y-m-d'));
    })->dailyAt('08:00');
}

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
