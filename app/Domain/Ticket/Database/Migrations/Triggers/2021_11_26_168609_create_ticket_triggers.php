<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateTicketTriggers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE TRIGGER ticket_created 
            AFTER INSERT ON `tickets` 
            FOR EACH ROW
        BEGIN
            DECLARE userName VARCHAR(191) DEFAULT '';
            DECLARE statusName VARCHAR(191) DEFAULT '';
            DECLARE severityName VARCHAR(191) DEFAULT '';
            DECLARE categoryName VARCHAR(191) DEFAULT '';
            DECLARE agentName VARCHAR(191) DEFAULT '';

            SELECT `name` into userName from users where users.id = NEW.user_id;
            SELECT `name` into statusName from statuses where statuses.id = NEW.status_id;
            SELECT `name` into severityName from severities where severities.id = NEW.severity_id;

            INSERT INTO tickets_view(
                id,
                subject,
                body,
                user_id,
                severity_id,
                status_id,
                solved,
                created_at,
                updated_at,
                deleted_at,
                user_name,
                status_name,
                severity_name,
                category_name,
                agent_name
            ) values(
                NEW.id,
                NEW.subject,
                NEW.body,
                NEW.user_id,
                NEW.severity_id,
                NEW.status_id,
                NEW.solved,
                NEW.created_at,
                NEW.updated_at,
                NEW.deleted_at,
                userName,
                statusName,
                severityName,
                categoryName,
                agentName
            );
        END");

        DB::statement("CREATE TRIGGER ticket_updated 
            AFTER UPDATE ON `tickets` 
            FOR EACH ROW
            BEGIN
                DECLARE userName VARCHAR(191) DEFAULT '';
                DECLARE statusName VARCHAR(191) DEFAULT '';
                DECLARE severityName VARCHAR(191) DEFAULT '';
                DECLARE categoryName VARCHAR(191) DEFAULT '';
                DECLARE agentName VARCHAR(191) DEFAULT '';

                SELECT `name` into userName from users where users.id = NEW.user_id;
                SELECT `name` into statusName from statuses where statuses.id = NEW.severity_id;
                SELECT `name` into severityName from severities where severities.id = NEW.status_id;

                INSERT INTO tickets_view(
                    id,
                    subject,
                    body,
                    user_id,
                    severity_id,
                    status_id,
                    solved,
                    created_at,
                    updated_at,
                    deleted_at,
                    user_name,
                    status_name,
                    severity_name,
                    category_name,
                    agent_name
                ) values(
                    NEW.id,
                    NEW.subject,
                    NEW.body,
                    NEW.user_id,
                    NEW.severity_id,
                    NEW.status_id,
                    NEW.solved,
                    NEW.created_at,
                    NEW.updated_at,
                    NEW.deleted_at,
                    userName,
                    statusName,
                    severityName,
                    categoryName,
                    agentName
                );
            END");

        DB::statement("CREATE TRIGGER ticket_deleted 
            AFTER DELETE ON `tickets` 
            FOR EACH ROW
        BEGIN
            DELETE FROM tickets_view WHERE id = OLD.id;
        END");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP TRIGGER IF EXISTS ticket_created");
        DB::statement("DROP TRIGGER IF EXISTS ticket_updated");
        DB::statement("DROP TRIGGER IF EXISTS ticket_deleted");
    }
}
