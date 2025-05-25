<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateAgentTicketTriggers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::statement("CREATE TRIGGER agent_ticket_created 
            AFTER INSERT ON `agent_ticket` 
            FOR EACH ROW
        BEGIN
            DECLARE agentNames TEXT DEFAULT '';
            
            SELECT GROUP_CONCAT(agents.name) into agentNames
            from agent_ticket
            left join users as agents on agent_ticket.agent_id = agents.id
            WHERE agent_ticket.ticket_id = NEW.ticket_id;

            UPDATE tickets_view SET agent_name = agentNames WHERE id = NEW.ticket_id;

        END");

        DB::statement("CREATE TRIGGER agent_ticket_updated 
            AFTER UPDATE ON `agent_ticket` 
            FOR EACH ROW
            BEGIN
            DECLARE agentNames TEXT DEFAULT '';
            
            SELECT GROUP_CONCAT(agents.name) into agentNames
            from agent_ticket
            left join users as agents on agent_ticket.agent_id = agents.id
            WHERE agent_ticket.ticket_id = NEW.ticket_id;


            UPDATE tickets_view SET agent_name = agentNames WHERE id = NEW.ticket_id;

        END");


        DB::statement("CREATE TRIGGER agent_ticket_deleted 
        AFTER DELETE ON `agent_ticket` 
        FOR EACH ROW
        BEGIN
            DECLARE agentNames TEXT DEFAULT '';
            
            SELECT GROUP_CONCAT(agents.name) into agentNames
            from agent_ticket
            left join users as agents on agent_ticket.agent_id = agents.id
            WHERE agent_ticket.ticket_id = OLD.ticket_id;

            UPDATE tickets_view SET agent_name = agentNames WHERE id = OLD.ticket_id;

        END");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP TRIGGER IF EXISTS agent_ticket_created");
        DB::statement("DROP TRIGGER IF EXISTS agent_ticket_updated");
        DB::statement("DROP TRIGGER IF EXISTS agent_ticket_deleted");
    }
}
