<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateDepartmentTriggers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE TRIGGER department_created 
            AFTER INSERT ON `departments` 
            FOR EACH ROW
        BEGIN
            INSERT INTO departments_view(
                name,
                description,
                status,
                created_at,
                updated_at
            ) values(
                NEW.name,
                NEW.description,
                NEW.status,
                NEW.created_at,
                NEW.updated_at
            );
        END");

        DB::statement("CREATE TRIGGER department_updated 
            AFTER UPDATE ON `departments` 
            FOR EACH ROW
        BEGIN
            UPDATE departments_view SET 
                name = NEW.name,
                description = NEW.description,
                status = NEW.status,
                updated_at = NEW.updated_at
            WHERE id = OLD.id;
        END");

        DB::statement("CREATE TRIGGER department_deleted 
        AFTER DELETE ON `departments` 
        FOR EACH ROW
        BEGIN
        DELETE FROM departments_view WHERE id = OLD.id;
        END");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP TRIGGER IF EXISTS department_created");
        DB::statement("DROP TRIGGER IF EXISTS department_updated");
        DB::statement("DROP TRIGGER IF EXISTS department_deleted");
    }
}
