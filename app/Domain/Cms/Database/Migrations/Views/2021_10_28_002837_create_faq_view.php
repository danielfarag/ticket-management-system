<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faqs_view', function (Blueprint $table) {
            
			$table->id();
			$table->text('question');
			$table->text('answer');
			$table->enum('status',['active', 'inactive']);
			$table->foreignId('department_id');
			$table->foreignId('article_id')->nullable();

            $table->string('department_name');
			$table->string('article_title')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('todos_view');
    }
}
