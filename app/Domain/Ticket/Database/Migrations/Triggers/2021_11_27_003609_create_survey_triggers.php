<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateSurveyTriggers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE TRIGGER survey_created 
            AFTER INSERT ON `surveys` 
            FOR EACH ROW
        BEGIN
            DECLARE ticketSubject VARCHAR(191) DEFAULT '';

            SELECT `subject` into ticketSubject from tickets where tickets.id = NEW.ticket_id;

            INSERT INTO surveys_view(
                ticket_id,
                resolved,
                comment,
                ticket_subject,
                created_at,
                updated_at
            ) values(
                NEW.ticket_id,
                NEW.resolved,
                NEW.comment,
                ticketSubject,
                NEW.created_at,
                NEW.updated_at
            );
        END");

        DB::statement("CREATE TRIGGER survey_updated 
            AFTER UPDATE ON `surveys` 
            FOR EACH ROW
        BEGIN
            DECLARE ticketSubject VARCHAR(191) DEFAULT '';

            SELECT `subject` into ticketSubject from tickets where tickets.id = NEW.ticket_id;

            UPDATE surveys_view SET 
                ticket_id = NEW.ticket_id,
                resolved = NEW.resolved,
                comment = NEW.comment,
                ticket_subject = ticketSubject
            WHERE id = OLD.id;
        END");

        DB::statement("CREATE TRIGGER survey_deleted 
        AFTER DELETE ON `surveys` 
        FOR EACH ROW
        BEGIN
        DELETE FROM surveys_view WHERE id = OLD.id;
        END");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP TRIGGER IF EXISTS survey_created");
        DB::statement("DROP TRIGGER IF EXISTS survey_updated");
        DB::statement("DROP TRIGGER IF EXISTS survey_deleted");
    }
}
