<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateFaqTriggers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE TRIGGER faq_created 
            AFTER INSERT ON `faqs` 
            FOR EACH ROW
        BEGIN
            DECLARE departmentName VARCHAR(191) DEFAULT '';
            DECLARE articleTitle VARCHAR(191) DEFAULT '';

            SELECT `name` into departmentName from departments where departments.id = NEW.department_id;
            SELECT `title` into articleTitle from articles where articles.id = NEW.article_id;

            INSERT INTO faqs_view(
                question,
                answer,
                status,
                department_id,
                article_id,
                department_name,
                article_title,
                created_at,
                updated_at
            ) values(
                NEW.question,
                NEW.answer,
                NEW.status,
                NEW.department_id,
                NEW.article_id,
                departmentName,
                articleTitle,
                NEW.created_at,
                NEW.updated_at
            );
        END");

        DB::statement("CREATE TRIGGER faq_updated 
            AFTER UPDATE ON `faqs` 
            FOR EACH ROW
        BEGIN
            DECLARE departmentName VARCHAR(191) DEFAULT '';
            DECLARE articleTitle VARCHAR(191) DEFAULT '';

            SELECT `name` into departmentName from departments where departments.id = NEW.department_id;
            SELECT `title` into articleTitle from articles where articles.id = NEW.article_id;

            UPDATE faqs_view SET 
                question = NEW.question,
                answer = NEW.answer,
                status = NEW.status,
                department_id = NEW.department_id,
                article_id = NEW.article_id,
                department_name = departmentName,
                article_title = articleTitle,
                updated_at = NEW.updated_at
            WHERE id = OLD.id;
        END");

        DB::statement("CREATE TRIGGER faq_deleted 
        AFTER DELETE ON `faqs` 
        FOR EACH ROW
        BEGIN
        DELETE FROM faqs_view WHERE id = OLD.id;
        END");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP TRIGGER IF EXISTS faq_created");
        DB::statement("DROP TRIGGER IF EXISTS faq_updated");
        DB::statement("DROP TRIGGER IF EXISTS faq_deleted");
    }
}
