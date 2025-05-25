<?php

namespace App\Common\Commands;

use App\Common\Services\DummyDataSeeder;
use App\Domain\User\Repositories\Contracts\RoleRepository;
use App\Domain\User\Repositories\Contracts\UserRepository;
use App\Infrastructure\Commands\AbstractCommand\BaseCommand as Command;

class DummySeederCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dummy {--confirm=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Super Admin Command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository)
    {
        parent::__construct();

        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if($this->option('confirm') == null){

            $this->error("This step can NOT be rolled back.");
            
            if($this->choice("This command will\n- DELETE ALL THE DATA\n- DROP ALL THE TABLES\n- Create empty tables\n- Fill them with dummy data.\nWould you like to proccede ?",['no', 'yes'], 'no') != 'yes'){
                $this->warn('Proccess Terminated');
                return 0;
            }
        }

        $this->call('migrate:fresh');

        $this->call(DummyDataSeeder::class);

        return 0;
    }
}
