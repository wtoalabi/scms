<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateActivitiesTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        protected $connection;
        public function up() {

            if(config('app.env') == 'local'){
                $this->connection = "mysql-activities";
                Schema::connection('mysql-activities')
                    ->dropIfExists('activities');
            }else{
                $this->connection = "sqlite-activities";
                Schema::connection('sqlite-activities')
                    ->dropIfExists('scms_activities');
            }
            Schema::connection($this->connection)
                ->create('activities', function (Blueprint $table) {
                    $table->bigIncrements('id');
                    $table->integer('actor_id');
                    $table->string('actor_role');
                    $table->string('actor_path');
                    $table->integer('subject_id');
                    $table->string('subject_type');
                    $table->string('subject_path');
                    $table->string('action');
                    $table->string('message');
                    $table->json('modifications')->nullable();
                    $table->timestamps();
                });
        }
    }
