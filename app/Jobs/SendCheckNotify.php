<?php

namespace App\Jobs;

use App\Models\Notification;
use App\Models\Payment;
use Carbon\Carbon;
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
        $cheques = Payment::where('pay_type','cheque')
        ->whereDate('due_date', '<=', Carbon::now()->addDays(3))
        ->whereNull('notified_at')
        ->get();
        foreach ($cheques as $cheque) {
            // ارسال اعلان
            Notification::create([
                'title' => 'موعد چک ها',
                'body' => "چک با شناسه {$cheque->id} در تاریخ {$cheque->due_date} موعد سررسید آن است.",
            ]);
            $cheque->notified_at = now();
            $cheque->save();
        }
    }
}