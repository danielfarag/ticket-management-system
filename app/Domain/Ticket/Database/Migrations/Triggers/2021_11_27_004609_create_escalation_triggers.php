<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateEscalationTriggers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE TRIGGER escalation_created 
            AFTER INSERT ON `escalations` 
            FOR EACH ROW
        BEGIN
            DECLARE ticketSubject VARCHAR(191) DEFAULT '';
            DECLARE creatorName VARCHAR(191) DEFAULT '';

            SELECT `subject` into ticketSubject from tickets where tickets.id = NEW.ticket_id;
            SELECT `name` into creatorName from users where users.id = NEW.creator_id;

            INSERT INTO escalations_view(
                creator_id,
                ticket_id,
                body,
                status,
                ticket_subject,
                creator_name,
                created_at,
                updated_at
            ) values(
                NEW.creator_id,
                NEW.ticket_id,
                NEW.body,
                NEW.status,
                ticketSubject,
                creatorName,
                NEW.created_at,
                NEW.updated_at
            );
        END");

        DB::statement("CREATE TRIGGER escalation_updated 
            AFTER UPDATE ON `escalations` 
            FOR EACH ROW
        BEGIN
            DECLARE ticketSubject VARCHAR(191) DEFAULT '';
            DECLARE creatorName VARCHAR(191) DEFAULT '';

            SELECT `subject` into ticketSubject from tickets where tickets.id = NEW.ticket_id;
            SELECT `name` into creatorName from users where users.id = NEW.creator_id;

            UPDATE escalations_view SET 
                creator_id = NEW.creator_id,
                ticket_id = NEW.ticket_id,
                body = NEW.body,
                status = NEW.status,
                ticket_subject = ticketSubject,
                creator_name = creatorName
            WHERE id = OLD.id;
        END");

        DB::statement("CREATE TRIGGER escalation_deleted 
        AFTER DELETE ON `escalations` 
        FOR EACH ROW
        BEGIN
        DELETE FROM escalations_view WHERE id = OLD.id;
        END");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP TRIGGER IF EXISTS escalation_created");
        DB::statement("DROP TRIGGER IF EXISTS escalation_updated");
        DB::statement("DROP TRIGGER IF EXISTS escalation_deleted");
    }
}
