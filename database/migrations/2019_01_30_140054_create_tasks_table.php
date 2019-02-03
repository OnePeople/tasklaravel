<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\{TaskType,TaskStatus};

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('theme');
            $table->string('code')->unique()->nullable();
            $table->text('content');
            $table->integer('creator_id')->unsigned();
            $table->integer('performer_id')->unsigned();
            $table->enum('type', TaskType::list());
            $table->enum('status', TaskStatus::list());
            $table->timestamps();
            $table->foreign('creator_id')
              ->references('id')->on('users')
              ->onDelete('CASCADE')
              ->onUpdate('CASCADE');
            $table->foreign('performer_id')
              ->references('id')->on('users')
              ->onDelete('CASCADE')
              ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
