<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateCategoryTriggers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::statement("CREATE TRIGGER category_created 
            AFTER INSERT ON `categorizables` 
            FOR EACH ROW
        BEGIN
            DECLARE categoryReferenceTable VARCHAR(191) DEFAULT '';
            DECLARE entity_id VARCHAR(191) DEFAULT '';
            DECLARE entity_type VARCHAR(191) DEFAULT '';
            DECLARE categoriesName VARCHAR(191) DEFAULT '';
            
            SET entity_id = NEW.categorizable_id;
            SET entity_type = NEW.categorizable_type;

            IF (entity_type != 'departments')
            THEN
                SELECT `type` into categoryReferenceTable from categories where categories.id = NEW.category_id;

                SELECT GROUP_CONCAT(categories.name) into categoriesName 
                from categorizables 
                left join categories on 
                    categories.id = categorizables.category_id and 
                    categorizables.categorizable_id = entity_id
                and  categories.type COLLATE utf8mb4_unicode_ci  = categoryReferenceTable;


                IF (categoryReferenceTable = 'articles')
                THEN
                    UPDATE articles_view SET category_name = categoriesName WHERE id = entity_id;
                END IF;

                IF (categoryReferenceTable = 'tickets')
                THEN
                    UPDATE tickets_view SET category_name = categoriesName WHERE id = entity_id;
                END IF;

                IF (categoryReferenceTable = 'departements')
                THEN
                    UPDATE departments_view SET categories = categoriesName WHERE id = entity_id;
                END IF;
            END IF;

            IF (entity_type = 'departments')
            THEN
                SELECT GROUP_CONCAT(categories.name) into categoriesName 
                from categorizables 
                left join categories on 
                    categories.id = categorizables.category_id and 
                    categorizables.categorizable_id = entity_id and 
                    categorizables.categorizable_type = 'departments' and 
                    categories.type COLLATE utf8mb4_unicode_ci  = 'tickets';


                UPDATE departments_view SET categories = categoriesName WHERE id = entity_id;
            END IF;

        END");

        DB::statement("CREATE TRIGGER category_updated 
            AFTER UPDATE ON `categorizables` 
            FOR EACH ROW
            BEGIN
            DECLARE categoryReferenceTable VARCHAR(191) DEFAULT '';
            DECLARE entity_id VARCHAR(191) DEFAULT '';
            DECLARE entity_type VARCHAR(191) DEFAULT '';
            DECLARE categoriesName VARCHAR(191) DEFAULT '';
            
            SET entity_id = NEW.categorizable_id;
            SET entity_type = NEW.categorizable_type;

            IF (entity_type != 'departments')
            THEN
                SELECT `type` into categoryReferenceTable from categories where categories.id = NEW.category_id;

                SELECT GROUP_CONCAT(categories.name) into categoriesName 
                from categorizables 
                left join categories on 
                    categories.id = categorizables.category_id and 
                    categorizables.categorizable_id = entity_id
                and  categories.type COLLATE utf8mb4_unicode_ci  = categoryReferenceTable;


                IF (categoryReferenceTable = 'articles')
                THEN
                    UPDATE articles_view SET category_name = categoriesName WHERE id = entity_id;
                END IF;

                IF (categoryReferenceTable = 'tickets')
                THEN
                    UPDATE tickets_view SET category_name = categoriesName WHERE id = entity_id;
                END IF;

                IF (categoryReferenceTable = 'departements')
                THEN
                    UPDATE departments_view SET categories = categoriesName WHERE id = entity_id;
                END IF;
            END IF;

            IF (entity_type = 'departments')
            THEN
                SELECT GROUP_CONCAT(categories.name) into categoriesName 
                from categorizables 
                left join categories on 
                    categories.id = categorizables.category_id and 
                    categorizables.categorizable_id = entity_id and 
                    categorizables.categorizable_type = 'departments' and 
                    categories.type COLLATE utf8mb4_unicode_ci  = 'tickets';


                UPDATE departments_view SET categories = categoriesName WHERE id = entity_id;
            END IF;

        END");


        DB::statement("CREATE TRIGGER category_deleted 
        AFTER DELETE ON `categorizables` 
        FOR EACH ROW
        BEGIN
            DECLARE categoryReferenceTable VARCHAR(191) DEFAULT '';
            DECLARE entity_id VARCHAR(191) DEFAULT '';
            DECLARE entity_type VARCHAR(191) DEFAULT '';
            DECLARE categoriesName VARCHAR(191) DEFAULT '';
            
            SET entity_id = OLD.categorizable_id;
            SET entity_type = OLD.categorizable_type;

            IF (entity_type != 'departments')
            THEN
                SELECT `type` into categoryReferenceTable from categories where categories.id = OLD.category_id;

                SELECT GROUP_CONCAT(categories.name) into categoriesName 
                from categorizables 
                left join categories on 
                    categories.id = categorizables.category_id and 
                    categorizables.categorizable_id = entity_id
                and  categories.type COLLATE utf8mb4_unicode_ci  = categoryReferenceTable;


                IF (categoryReferenceTable = 'articles')
                THEN
                    UPDATE articles_view SET category_name = categoriesName WHERE id = entity_id;
                END IF;

                IF (categoryReferenceTable = 'tickets')
                THEN
                    UPDATE tickets_view SET category_name = categoriesName WHERE id = entity_id;
                END IF;

                IF (categoryReferenceTable = 'departements')
                THEN
                    UPDATE departments_view SET categories = categoriesName WHERE id = entity_id;
                END IF;
            END IF;

            IF (entity_type = 'departments')
            THEN
                SELECT GROUP_CONCAT(categories.name) into categoriesName 
                from categorizables 
                left join categories on 
                    categories.id = categorizables.category_id and 
                    categorizables.categorizable_id = entity_id and 
                    categorizables.categorizable_type = 'departments' and 
                    categories.type COLLATE utf8mb4_unicode_ci  = 'tickets';


                UPDATE departments_view SET categories = categoriesName WHERE id = entity_id;
            END IF;

        END");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP TRIGGER IF EXISTS category_created");
        DB::statement("DROP TRIGGER IF EXISTS category_updated");
        DB::statement("DROP TRIGGER IF EXISTS category_deleted");
    }
}
