<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendCheckNotify implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $cheques = Payment::whereNotNull('due_date')
        ->whereDate('due_date', '<=', Carbon::now()->addDays(3))
        ->whereNull('notified_at')
        ->get();

        foreach ($cheques as $cheque) {
            // ارسال اعلان
            $vertaDate = verta($cheque->due_date);
            Notification::create([
                'title' => 'موعد چک ها',
                'body' => "چک با شناسه {$cheque->id} در تاریخ {$vertaDate->format('Y/n/j')} موعد سررسید آن است.",
            ]);
        }
        foreach ($cheques as $cheque) {
            $cheque->update(['notified_at' => now()]);
        }
    }
}