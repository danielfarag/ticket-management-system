<?php
namespace App\Domain\Interaction\Commands;

use App\Domain\Interaction\Jobs\SendMailsJob;
use App\Infrastructure\Commands\AbstractCommand\BaseCommand as Command;

class SendMailsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send_mails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'SendMailsCommand description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        SendMailsJob::dispatch();

        $this->warn('We are processing the mails!');
        return 00;
    }
}
