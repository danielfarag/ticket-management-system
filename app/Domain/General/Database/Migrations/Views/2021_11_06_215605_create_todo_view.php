<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatetodoView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todos_view', function (Blueprint $table) {
            
            $table->id();
			$table->string('subject');
			$table->string('body');
			$table->enum('priority', ['low', 'medium', 'high'])->default('low');
			$table->enum('status', ['done', 'idle', 'todo', 'in_progress', 'urget'])->default('todo');
			$table->foreignId('agent_id');
			$table->datetime('due_at');
			$table->string('agent_name');
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
