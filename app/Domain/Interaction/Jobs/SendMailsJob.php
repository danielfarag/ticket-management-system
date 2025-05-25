<?php

namespace App\Domain\Interaction\Jobs;

use App\Domain\Interaction\Mail\CustomMail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Domain\Interaction\Repositories\Contracts\MailRepository;
use Illuminate\Support\Facades\Mail;

class SendMailsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Define Mail Repository
     * 
     * @var MailRepository
     */
    private $mailRepository;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->mailRepository = app()->make(MailRepository::class);
     
        $timeStart = \Carbon\Carbon::now()->subMinutes(150);
        
        $timeEnd = \Carbon\Carbon::now()->addMinutes(150);

        $mails = $this->mailRepository->where('status', 'pending')->whereBetween('send_at', [$timeStart, $timeEnd])->take(5)->get();

        $mails->map(function($mail){
            Mail::to(explode(',', $mail->email))->queue(new CustomMail($mail));
            $mail->status = 'sent';
            $mail->save();
        });

    }
}
