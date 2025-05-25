<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateEscalationView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escalations_view', function (Blueprint $table) {
            
			$table->id();
			$table->foreignId('creator_id');
			$table->foreignId('ticket_id');
			$table->text('body');
			$table->enum('status',[ 'pending', 'in_progress', 'solved'])->default('pending');
			$table->text('ticket_subject');
			$table->text('creator_name');
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
        Schema::dropIfExists('escalations_view');
    }
}
