<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateUserTriggers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE TRIGGER user_created 
            AFTER INSERT ON `users` 
            FOR EACH ROW
        BEGIN
            INSERT INTO users_view(
                name,
                email,
                phone_number,
                email_verified_at,
                password,
                type,
                status,
                created_at,
                updated_at
            ) values(
                NEW.name,
                NEW.email,
                NEW.phone_number,
                NEW.email_verified_at,
                NEW.password,
                NEW.type,
                NEW.status,
                NEW.created_at,
                NEW.updated_at
            );
        END");

        DB::statement("CREATE TRIGGER user_updated 
            AFTER UPDATE ON `users` 
            FOR EACH ROW
        BEGIN
            UPDATE users_view SET 
                name = NEW.name,
                email = NEW.email,
                phone_number = NEW.phone_number,
                email_verified_at = NEW.email_verified_at,
                password = NEW.password,
                type = NEW.type,
                status = NEW.status,
                created_at = NEW.created_at,
                updated_at = NEW.updated_at
            WHERE id = OLD.id;
        END");

        DB::statement("CREATE TRIGGER user_deleted 
        AFTER DELETE ON `users` 
        FOR EACH ROW
        BEGIN
        DELETE FROM users_view WHERE id = OLD.id;
        END");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP TRIGGER IF EXISTS user_created");
        DB::statement("DROP TRIGGER IF EXISTS user_updated");
        DB::statement("DROP TRIGGER IF EXISTS user_deleted");
    }
}
