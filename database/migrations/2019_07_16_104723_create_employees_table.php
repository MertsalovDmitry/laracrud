<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 256);
            $table->string('email');
            $table->string('phone');
            $table->string('photo');
            $table->bigInteger('position_id')->unsigned()->nullable();
            $table->double('salary', 6, 3)->nullable()->default(0);
            $table->date('employed_at');
            $table->bigInteger('admin_created_id')->unsigned()->nullable();
            $table->bigInteger('admin_updated_id')->unsigned()->nullable();

            $table->timestamps();

            $table->foreign('position_id')->references('id')->on('positions')->onDelete('set null');
            $table->foreign('admin_created_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('admin_updated_id')->references('id')->on('users')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropForeign('employees_position_id_foreign');
        $table->dropForeign('users_admin_created_id_foreign');
        $table->dropForeign('users_admin_updated_id_foreign');
        Schema::dropIfExists('employees');
    }
}
