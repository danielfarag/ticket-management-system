<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentView extends Migration
{
    public function up()
    {
        Schema::create('departments_view', function (Blueprint $table) {
            
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->enum('status',['active','inactive']);
            $table->text('categories')->nullable()->comment('trigger categories created - check type');
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
        Schema::dropIfExists('departments_view');
    }
}
