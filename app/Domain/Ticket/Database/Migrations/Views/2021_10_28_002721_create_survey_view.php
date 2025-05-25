<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatesurveyView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveys_view', function (Blueprint $table) {
            
			$table->id();
			$table->foreignId('ticket_id');
			$table->enum('resolved',[ 'yes', 'no' ]);
			$table->text('comment')->nullable();
			$table->string('ticket_subject');
			$table->timestamps();

        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surveys_view');
    }
}
