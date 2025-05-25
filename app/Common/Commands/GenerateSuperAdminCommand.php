<?php

namespace App\Common\Commands;

use Illuminate\Support\Str;
use App\Domain\User\Database\Seeds\RoleTableSeeder;
use App\Domain\User\Repositories\Contracts\RoleRepository;
use App\Domain\User\Repositories\Contracts\UserRepository;
use App\Infrastructure\Commands\AbstractCommand\BaseCommand as Command;

class GenerateSuperAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'super_admin';

    /**
     * Set The User Email.
     *
     * @var string
     */
    protected $email = 'admin@domain.com';

    /**
     * Set The User Password.
     *
     * @var string
     */
    protected $password = 'password';

    /**
     * Define UserRepository.
     *
     * @var UserRepository
     */
    private $userRepository;

    /**
     * Define RoleRepository.
     *
     * @var RoleRepository
     */
    private $roleRepository;

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
        $admin = $this->roleRepository->where(['name'=>'admin'])->first();

        if(!$admin){
            $this->error('No Roles are available in the website,');
            $this->warn('Role seeder will run');
            if(!$this->confirm('Do you wish to continue? (yes|no)[no]',true))
            {
                $this->info("Process terminated by user");
                return;
            }
            $this->call('db:seed', ['class'=> RoleTableSeeder::class]);
            $admin = $this->roleRepository->where(['name'=>'admin'])->first();
        }

        $user = $this->userRepository->where(['email'=>$this->email])->first();
        
        if($user){
            $user->update([
                "password"      => bcrypt($this->password),
            ]);
        }else{
            $user = $this->userRepository->updateOrCreate([
                "email"             => $this->email,
                "email_verified_at" => now(),
                "remember_token"    => Str::random(10),
            ],[
                "name"              => "admin",
                "phone_number"      => "123456789",
                "password"          => $this->password,
                "status"            => "active",
                "type"              => "admin",
                "password"          => "password",
            ]);
        }


        $user->syncRoles($admin->id);

        $this->table(["email", "password", "Role"], [[$user->email, $this->password, $user->role->name]]);
        
        return 0;
    }
}
