<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateBlockIpTriggers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE TRIGGER block_ip_created 
            AFTER INSERT ON `block_ips` 
            FOR EACH ROW
        BEGIN
            DECLARE blockerName VARCHAR(191) DEFAULT '';

            SELECT `name` into blockerName from users where users.id = NEW.blocker_id;

            INSERT INTO block_ips_view(
                blocker_id,
                blocker_name,
                ip_address,
                reason,
                created_at,
                updated_at
            ) values(
                NEW.blocker_id,
                blockerName,
                NEW.ip_address,
                NEW.reason,
                NEW.created_at,
                NEW.updated_at
            );
        END");

        DB::statement("CREATE TRIGGER block_ip_updated 
            AFTER UPDATE ON `block_ips` 
            FOR EACH ROW
        BEGIN
            DECLARE blockerName VARCHAR(191) DEFAULT '';

            SELECT `name` into blockerName from users where users.id = NEW.blocker_id;

            UPDATE block_ips_view SET 
                blocker_id = NEW.blocker_id,
                blocker_name = blockerName,
                ip_address = NEW.ip_address,
                reason = NEW.reason,
                updated_at = NEW.updated_at
            WHERE id = OLD.id;
        END");

        DB::statement("CREATE TRIGGER block_ip_deleted 
            AFTER DELETE ON `block_ips` 
            FOR EACH ROW
        BEGIN
            DELETE FROM block_ips_view WHERE id = OLD.id;
        END");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP TRIGGER IF EXISTS block_ip_created");
        DB::statement("DROP TRIGGER IF EXISTS block_ip_updated");
        DB::statement("DROP TRIGGER IF EXISTS block_ip_deleted");
    }
}
