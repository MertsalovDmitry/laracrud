<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 256)->unique();
            $table->bigInteger('admin_created_id')->unsigned()->nullable();
            $table->bigInteger('admin_updated_id')->unsigned()->nullable();
            $table->timestamps();

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
        $table->dropForeign('users_admin_created_id_foreign');
        $table->dropForeign('users_admin_updated_id_foreign');
        Schema::dropIfExists('positions');
    }
}
