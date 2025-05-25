<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateRoleTriggers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE TRIGGER role_created 
        AFTER INSERT ON `model_has_roles` 
        FOR EACH ROW
        BEGIN
            DECLARE user_id VARCHAR(191) DEFAULT '';
            DECLARE rolesName VARCHAR(191) DEFAULT '';
            
            SET user_id = NEW.model_id;

            SELECT GROUP_CONCAT(roles.name) into rolesName 
            from model_has_roles 
            left join roles on 
                roles.id = model_has_roles.role_id and 
                model_has_roles.model_id = user_id;


            UPDATE users_view SET roles = rolesName WHERE id = user_id;

        END");

        DB::statement("CREATE TRIGGER role_updated 
        AFTER UPDATE ON `model_has_roles` 
        FOR EACH ROW
        BEGIN
            DECLARE user_id VARCHAR(191) DEFAULT '';
            DECLARE rolesName VARCHAR(191) DEFAULT '';
            
            SET user_id = NEW.model_id;

            SELECT GROUP_CONCAT(roles.name) into rolesName 
            from model_has_roles 
            left join roles on 
                roles.id = model_has_roles.role_id and 
                model_has_roles.model_id = user_id;


            UPDATE users_view SET roles = rolesName WHERE id = user_id;

        END");

        DB::statement("CREATE TRIGGER role_deleted 
        AFTER DELETE ON `model_has_roles` 
        FOR EACH ROW
        BEGIN
            DECLARE user_id VARCHAR(191) DEFAULT '';
            DECLARE rolesName VARCHAR(191) DEFAULT '';
            
            SET user_id = OLD.model_id;

            SELECT GROUP_CONCAT(roles.name) into rolesName 
            from model_has_roles 
            left join roles on 
                roles.id = model_has_roles.role_id and 
                model_has_roles.model_id = user_id;


            UPDATE users_view SET roles = rolesName WHERE id = user_id;

        END");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP TRIGGER IF EXISTS role_created");
        DB::statement("DROP TRIGGER IF EXISTS role_updated");
        DB::statement("DROP TRIGGER IF EXISTS role_deleted");
    }
}
