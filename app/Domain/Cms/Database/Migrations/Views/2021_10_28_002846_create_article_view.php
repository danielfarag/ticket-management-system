<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatearticleView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles_view', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->text('body');
			$table->foreignId('author_id');
			$table->enum('status',['active', 'inactive']);
			$table->string('author_name');
			$table->string('category_name')->nullable();
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
        Schema::dropIfExists('articles_view');
    }
}
