<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignedEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assigned_employees', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned()->index(); // this is working
            $table->foreign('user_id')->references('id')->on('users')->nullable()->onDelete('cascade');;

            $table->bigInteger('supervised_id')->unsigned()->index(); // this is working
            $table->foreign('supervised_id')->references('id')->on('users')->nullable()->onDelete('cascade');;

            $table->enum('status', ['Need Approval', 'Completed'])->default('Need Approval');
            $table->string('user_name');
            $table->primary(['user_id', 'supervised_id']);
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
        Schema::dropIfExists('assigned_employees');
    }
}
