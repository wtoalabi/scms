<?php
  
  use Illuminate\Support\Facades\Schema;
  use Illuminate\Database\Schema\Blueprint;
  use Illuminate\Database\Migrations\Migration;
  
  class CreateAccountRolesTable extends Migration
  {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
      Schema::create('account_roles', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->unsignedInteger('role_id');
        $table->unsignedInteger('account_id');
        $table->string('account_type');
        $table->softDeletes();
        $table->timestamps();
      });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
      Schema::dropIfExists('account_roles');
    }
  }
