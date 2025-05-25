<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateArticleTriggers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE TRIGGER article_created 
            AFTER INSERT ON `articles` 
            FOR EACH ROW
        BEGIN
            DECLARE authorName VARCHAR(191) DEFAULT '';

            SELECT `name` into authorName from users where users.id = NEW.author_id;

            INSERT INTO articles_view(
                title,
                body,
                author_id,
                status,
                author_name,
                created_at,
                updated_at
            ) values(
                NEW.title,
                NEW.body,
                NEW.author_id,
                NEW.status,
                authorName,
                NEW.created_at,
                NEW.updated_at
            );
        END");

        DB::statement("CREATE TRIGGER article_updated 
            AFTER UPDATE ON `articles` 
            FOR EACH ROW
        BEGIN
            DECLARE authorName VARCHAR(191) DEFAULT '';

            SELECT `name` into authorName from users where users.id = NEW.author_id;

            UPDATE articles_view SET 
                title = NEW.title,
                body = NEW.body,
                author_id = NEW.author_id,
                status = NEW.status,
                author_name = authorName,
                updated_at = NEW.updated_at
            WHERE id = OLD.id;
        END");

        DB::statement("CREATE TRIGGER article_deleted 
        AFTER DELETE ON `articles` 
        FOR EACH ROW
        BEGIN
        DELETE FROM articles_view WHERE id = OLD.id;
        END");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP TRIGGER IF EXISTS article_created");
        DB::statement("DROP TRIGGER IF EXISTS article_updated");
        DB::statement("DROP TRIGGER IF EXISTS article_deleted");
    }
}
