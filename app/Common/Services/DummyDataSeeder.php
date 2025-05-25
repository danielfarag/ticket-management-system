<?php

namespace App\Common\Services;

use Illuminate\Database\Seeder;
use App\Domain\Cms\Entities\Faq;
use App\Domain\User\Entities\User;
use App\Domain\Cms\Entities\Article;
use App\Domain\Ticket\Entities\Note;
use App\Domain\General\Entities\Todo;
use App\Domain\Ticket\Entities\Status;
use App\Domain\Ticket\Entities\Survey;
use App\Domain\Ticket\Entities\Ticket;
use App\Domain\General\Entities\Slider;
use App\Domain\Setting\Entities\Member;
use App\Domain\General\Entities\Comment;
use App\Domain\General\Entities\Service;
use App\Domain\Setting\Entities\BlockIp;
use App\Domain\Ticket\Entities\Severity;
use Spatie\Permission\Models\Permission;
use App\Domain\General\Entities\Category;
use App\Domain\Interaction\Entities\Mail;
use App\Domain\Setting\Entities\QuickLink;
use App\Domain\Ticket\Entities\Department;
use App\Domain\Ticket\Entities\Escalation;
use Spatie\Permission\PermissionRegistrar;
use App\Domain\Interaction\Entities\Contact;
use App\Domain\Interaction\Entities\Announcement;
use App\Domain\Interaction\Entities\MailTemplate;
use App\Domain\Setting\Entities\Setting;
use App\Domain\User\Repositories\Contracts\RoleRepository;
use Faker\Factory;

class DummyDataSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $this->createRoles();
        $this->createUsers();
        $this->createTodos();

        $this->createStatuses();
        $this->createSeverities();
        $this->createCategories();
        $this->createDepartments();

        $this->createTickets();
        $this->createAnnouncements();
        $this->createContacts();
        


        $this->createMails();
        $this->createMailTemplates();
        $this->createArticles();
        $this->createFaqs();
        
        $this->createBlockIps();
        $this->createQuickLinks();
        $this->createServices();
        $this->createSliders();
        $this->createMembers();
        $this->createSettings();
    }

    private function createRoles(){
        try {
            app()[PermissionRegistrar::class]->forgetCachedPermissions();
            $roleRepository = app()->make(RoleRepository::class);
            $permissions = collect([]);
            collect($roleRepository->permissions)->map(function($group) use(&$permissions){
                $permissions = $permissions->merge(array_keys($group['permissions']));
            });

            $permissions = $permissions->map(function($permission){
                return ['name'=>$permission, 'guard_name'=>'web'];
            });
            Permission::insert($permissions->toArray());

            $roleRepository->create(['name'=>'admin', 'guard_name'=>'web'])->permissions()->attach(Permission::all());

            $roleRepository->create(['name'=>'agent', 'guard_name'=>'web'])->permissions()->attach($this->getAgentPermissions());

            $roleRepository->create(['name'=>'supervisor', 'guard_name'=>'web'])->permissions()->attach($this->getSupervisorPermissions());

            $roleRepository->create(['name'=>'leader', 'guard_name'=>'web'])->permissions()->attach($this->getLeaderPermissions());
        } catch (\Throwable $th) {}
    }


    private function getSupervisorPermissions(){
        return Permission::query()
        ->where('name', 'LIKE', '%_department')
        ->orWhere('name', 'LIKE', '%_todo')
        ->orWhere('name', 'LIKE', '%_escalation')
        ->get();
    }

    private function getAgentPermissions(){
        return Permission::query()
        ->where('name', 'LIKE', '%_ticket')
        ->orWhere('name', 'LIKE', '%_todo')
        ->orWhere('name', 'LIKE', '%_escalation')
        ->get();
    }

    private function getLeaderPermissions(){
        return Permission::query()
        ->where('name', 'LIKE', '%_ticket')
        ->orWhere('name', 'LIKE', '%_todo')
        ->orWhere('name', 'LIKE', '%_escalation')
        ->orWhere('name', 'LIKE', '%_status')
        ->orWhere('name', 'LIKE', '%_severity')
        ->orWhere('name', 'LIKE', '%_department')
        ->get();
    }


    private function createUsers(){
        User::factory(100)->user()->create();

        $admin = User::factory()->active()->admin()->make(['name' => 'Admin', 'email' => 'admin@domain.com']);
        $admin->save();
        
        $agent = User::factory()->active()->agent()->make(['name' => 'Agent', 'email' => 'agent@domain.com']);
        $agent->save();
        
        $supervisor = User::factory()->active()->agent()->make(['name' => 'Supervisor', 'email' => 'supervisor@domain.com']);
        $supervisor->save();
        
        $leader = User::factory()->active()->agent()->make(['name' => 'Leader', 'email' => 'leader@domain.com']);
        $leader->save();

        $user = User::factory()->active()->user()->make(['name' => 'User', 'email' => 'user@domain.com']);
        $user->save();
        
        
        $admin->assignRole('admin');
        $agent->assignRole('agent');
        $supervisor->assignRole('supervisor');
        $leader->assignRole('leader');
    }

    
    private function createTodos(){
        $agents = User::where('type', 'agent')->get();

        foreach ($agents as $agent) {
            $agent->todos()->saveMany(Todo::factory(20)->make(['agent_id' => 0]));
        }
    }


    private function createStatuses(){
        Status::factory()->active()->create(['name'=>'pending', 'color'=>'#88ff53']);
        Status::factory()->active()->create(['name'=>'in_progress', 'color'=>'#00f3ff']);
        Status::factory()->active()->create(['name'=>'waiting_customer_reply', 'color'=>'#fad0a1']);
        Status::factory()->active()->create(['name'=>'hold', 'color'=>'#fba1a1']);
        Status::factory()->active()->create(['name'=>'closed', 'color'=>'#f00']);
    }

    private function createSeverities(){
        Severity::factory()->active()->create(['name'=>'low', 'color'=>'#88ff53']);
        Severity::factory()->active()->create(['name'=>'average', 'color'=>'#00f3ff']);
        Severity::factory()->active()->create(['name'=>'high', 'color'=>'#fba1a1']);
        Severity::factory()->active()->create(['name'=>'critical', 'color'=>'#f00']);
    }

    private function createCategories(){
        Category::factory()->ticket()->create(['name'=>'Server Troubleshooting']);
        Category::factory()->ticket()->create(['name'=>'Office - Productivity']);
        Category::factory()->ticket()->create(['name'=>'New User - User Leaving']);
        Category::factory()->ticket()->create(['name'=>'File Storage']);
        Category::factory()->ticket()->create(['name'=>'Issue Diagnosing']);


        Category::factory()->article()->create(['name'=>'Servers']);
        Category::factory()->article()->create(['name'=>'Productivity']);
        Category::factory()->article()->create(['name'=>'Users']);
        Category::factory()->article()->create(['name'=>'Storage']);
    }

    private function createDepartments(){
        Department::factory()->active()->make(['name'=>'Your Account'])->save();
        Department::factory()->active()->make(['name'=>'Copyrights'])->save();
        Department::factory()->active()->make(['name'=>'Tax & Compalince'])->save();
        Department::factory()->active()->make(['name'=>'Purchasing Item'])->save();
        Department::factory()->active()->make(['name'=>'Licensing'])->save();
        Department::factory()->active()->make(['name'=>'Affilates'])->save();
        
        $departments = Department::all();

        $categories = Category::where('type','tickets')->get();
        $agents = User::where('type','agent')->get();

        foreach ($departments as $department) {
            $department->addMedia(storage_path('seeder/departments/'.random_int(1,6).'.png'))->preservingOriginal()->toMediaCollection('image');

            $department->categories()->attach($categories->random());

            $department->agents()->attach($agents->random());
        }
    }

    private function createTickets(){
        $_users = User::all();
        $users = $_users->where('type', 'user');
        $agents = $_users->where('type', 'agent');
        $categories = Category::where('type', 'tickets')->get();
        $statuses = Status::all();
        $severities = Severity::all();
        
        foreach ($users as $user) {
            $_tickets = Ticket::factory(random_int(1,4))->make([
                'user_id'       => null,
                'severity_id'   => $severities->random()->id,
                'status_id'     => $statuses->random()->id,
            ]);
            $tickets = $user->tickets()->saveMany($_tickets);

            foreach ($tickets as $ticket) {
                $_agents = $agents->random(random_int(1,3));

                $ticket->categories()->attach($categories->random());

                $ticket->agents()->sync($_agents);

                $notes = collect([]);
                $comments = collect([]);

                foreach ($_agents as $agent) {
                    $notes = $notes->merge(Note::factory(random_int(0, 2))->make([
                        'agent_id'=>$agent->id,
                    ]));

                    $comments = $comments->merge(Comment::factory(random_int(1, 2))->make([
                        'user_id'   =>  random_int(0,50) > 30 ? $ticket->user_id : $agent->id
                    ]));

                }

                $comments = $comments->merge(Comment::factory(random_int(1, 2))->make([
                    'user_id'   =>  $ticket->user_id,
                ]));


                $ticket->notes()->saveMany($notes);
                $ticket->comments()->saveMany($comments);

                
                if(random_int(0,50) > 30){
                    $ticket->escalation()->save(Escalation::factory()->make([
                        'creator_id' => $_agents->random()->id
                    ]));
                }

                if(random_int(0,50) > 30){
                    $ticket->survey()->save(Survey::factory()->make());
                }

            }
        }
    }

    private function createAnnouncements(){
        Announcement::factory(10)->create();
    }

    private function createContacts(){
        Contact::factory(60)->create();
    }


    public function createMails(){
        Mail::factory(60)->create();
    }

    public function createMailTemplates(){
        MailTemplate::factory(5)->create();
    }

    public function createArticles(){
        $agents = User::where('type','agent')->get();

        $categories = Category::where('type','articles')->get();
        
        $articles = Article::factory(30)->make([
            'author_id' => $agents->random()->id
        ])->makeHidden(['categories',"category","image","seen", "useful"]);
        

        Article::insert($this->fillDates($articles));
        
        $articles = Article::all();
                    
        foreach ($articles as $article) {
            $article->categories()->attach($categories->random());
            $article->addMedia(storage_path('seeder/articles/'.random_int(1,4).'.jpg'))->preservingOriginal()->toMediaCollection('image');
        }
    }


    public function createFaqs(){
        $departments = Department::all(); 
        $articles = Article::all();
        Faq::factory(14)->create([
            'department_id' => $departments->random()->id,
            'article_id'    => $articles->random()->id
        ]);
        Faq::factory(9)->create([
            'department_id' => $departments->random()->id,
            'article_id'    => null
        ]);
    }

    public function createBlockIps(){
        $agents  = User::where('type','agent')->get();
        
        foreach ($agents as $agent) {
            BlockIp::factory(random_int(0,3))->create([
                'blocker_id'=>$agent->id
            ]);
        }
    }

    public function createQuickLinks(){
        QuickLink::factory(5)->create();
    }

    public function createServices(){
        Service::factory(15)->create();
    }

    public function createSliders(){
        $sliders = Slider::factory(6)->make()->makeHidden(['image']);

        Slider::insert($this->fillDates($sliders));
        
        $sliders = Slider::all(); 
     
        foreach ($sliders as $slide) {
            $slide->addMedia(storage_path('seeder/sliders/'.random_int(1,4).'.jpg'))->preservingOriginal()->toMediaCollection('image');
        }
    }

    public function createMembers(){
        $members = Member::factory(6)->make()->makeHidden(['image']);
        
        Member::insert($this->fillDates($members));
        
        $members = Member::all();

        foreach ($members as $member) {
            $member->addMedia(storage_path('seeder/members/'.random_int(1,4).'.jpg'))->preservingOriginal()->toMediaCollection('image');
        }
    }

    public function createSettings(){
        $faker = Factory::create();
        $keys = [
            'name'                         => $faker->words(2, true),
            'email'                        => $faker->email(),
            'phone_number'                 => $faker->phoneNumber(),
            'working_hours'                => 'Mon-Fri 10-22',
            'keywords'                     => str_replace(' ', '|', $faker->sentence()),
            'description'                  => $faker->sentences(3,true),
            'default_status'               => Status::all()->random()->id,
            'default_severity'             => Severity::all()->random()->id,

            'footer_about'                 => $faker->paragraphs(5, true),
            'copyrights'                   => 'Supporter 2021 Powered BY domain',
            'address'                      => $faker->address,
            'show_address'                 => true,
            'show_quick_links'             => true,
            'show_about'                   => true,
            'show_social_networks'         => true,

            'facebook_url'                 => 'https://www.facebook.com/fb',
            'linkedin_url'                 => 'https://www.linkedin.com/fb',
            'twitter_url'                  => 'https://www.twitter.com/fb',
            'instagram_url'                => 'https://www.instagram.com/fb',

            'terms_conditions'             => $faker->paragraphs(20, true),
            'about'                        => $faker->paragraphs(20, true),
            'privacy_policy'               => $faker->paragraphs(20, true),
            
            'emails_notify'                => join('|', [$faker->email, $faker->email, $faker->email]),
            'sent_mail_ticket_created'     => true,
            'user_can_delete_ticket'       => true,

            'show_slider'                  => true,
            'show_search'                  => true,
            'show_departments'             => true,
            'show_submit_ticket'           => true,
            'show_faq'                     => true,
            'show_help'                    => true,
        ];

        $index = 0;
        foreach ($keys as $key => $value) {
            $settings[$index]['key'] = $key;
            $settings[$index++]['value'] = $value;
        }

        Setting::insert($settings);
    }


    private function fillDates($collection){
        return $collection->map(function($entity){
            return array_merge($entity->toArray(), ['created_at'=>now(), 'updated_at'=>now()]);
        })->toArray();
    }
}
