<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUserView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_view', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('type',[
                'admin',
                'agent',
                'user'
            ])->default('user');
            $table->enum('status',[
                'active',
                'inactive'
            ]);

            $table->string('roles')->nullable()->comment('trigger roles assigned - updated');
            $table->integer('tickets_created')->default(0)->comment('trigger ticket created - increment');
            $table->integer('tickets_assigned')->default(0)->comment('trigger ticket assigned - increment');

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_view');
    }
}


// <?php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Support\Facades\DB;

// class CreateUserView extends Migration
// {
//     /**
//      * Run the migrations.
//      *
//      * @return void
//      */
//     public function up()
//     {
//         DB::statement("
//         CREATE OR REPLACE VIEW user_view
//             AS
//         SELECT 
//             users.*,
//             ". (in_array(config("database.default"),['sqlite','mysql']) ? "GROUP_CONCAT(roles.name)" : "array_to_string(array_agg(roles.name), ',')") ." as roles,
//             (SELECT count(*) from tickets where user_id = users.id) as tickets_created,
//             (SELECT count(*) from agent_ticket where agent_id = users.id) as tickets_assigned
//         from users
//         LEFT JOIN model_has_roles on model_has_roles.model_id = users.id and model_has_roles.model_type = 'user' 
//         LEFT JOIN roles on model_has_roles.role_id = roles.id
//         GROUP BY 
//             users.id,
//             users.name,
//             users.email,
//             users.phone_number,
//             users.email_verified_at,
//             users.password,
//             users.type,
//             users.status,
//             users.remember_token,
//             users.created_at,
//             users.updated_at
//        ");
//     }

//     /**
//      * Reverse the migrations.
//      *
//      * @return void
//      */
//     public function down()
//     {
//         DB::statement("DROP VIEW IF EXISTS user_view");
//     }
// }


