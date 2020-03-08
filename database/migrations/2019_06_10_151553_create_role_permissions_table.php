<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
          $table->unsignedBigInteger('role_id');
          $table->unsignedBigInteger('permission_id');
          $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
          $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
          $table->softDeletes();
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
        Schema::dropIfExists('role_permissions');
    }
}
