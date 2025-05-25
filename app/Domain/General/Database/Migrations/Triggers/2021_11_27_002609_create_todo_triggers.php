<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateTodoTriggers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE TRIGGER todo_created 
            AFTER INSERT ON `todos` 
            FOR EACH ROW
        BEGIN
            DECLARE agentName VARCHAR(191) DEFAULT '';

            SELECT `name` into agentName from users where users.id = NEW.agent_id;

            INSERT INTO todos_view(
                subject,
                body,
                priority,
                status,
                agent_id,
                agent_name,
                due_at,
                created_at,
                updated_at
            ) values(
                NEW.subject,
                NEW.body,
                NEW.priority,
                NEW.status,
                NEW.agent_id,
                agentName,
                NEW.due_at,
                NEW.created_at,
                NEW.updated_at
            );
        END");

        DB::statement("CREATE TRIGGER todo_updated 
            AFTER UPDATE ON `todos` 
            FOR EACH ROW
        BEGIN
            DECLARE agentName VARCHAR(191) DEFAULT '';

            SELECT `name` into agentName from users where users.id = NEW.agent_id;

            UPDATE todos_view SET 
                subject = NEW.subject,
                body = NEW.body,
                priority = NEW.priority,
                status = NEW.status,
                agent_id = NEW.agent_id,
                due_at = NEW.due_at,
                agent_name = agentName,
                updated_at = NEW.updated_at
            WHERE id = OLD.id;
        END");

        DB::statement("CREATE TRIGGER todo_deleted 
        AFTER DELETE ON `todos` 
        FOR EACH ROW
        BEGIN
        DELETE FROM todos_view WHERE id = OLD.id;
        END");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP TRIGGER IF EXISTS todo_created");
        DB::statement("DROP TRIGGER IF EXISTS todo_updated");
        DB::statement("DROP TRIGGER IF EXISTS todo_deleted");
    }
}
