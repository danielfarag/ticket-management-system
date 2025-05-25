<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets_view', function (Blueprint $table) {
            
			$table->id();

            $table->text('subject');
            $table->text('body');
            $table->foreignId('user_id');
            $table->foreignId('severity_id');
            $table->foreignId('status_id');
			$table->enum('solved',[ 'yes', 'no' ]);

			$table->string('user_name');
			$table->string('status_name');
			$table->string('severity_name');
			$table->string('category_name')->nullable()->comment('trigger categories created - check type');
			$table->text('agent_name')->nullable()->comment('trigger agents assigned');
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
        Schema::dropIfExists('tickets_view');
    }
}
