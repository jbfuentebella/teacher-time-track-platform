<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('account_id');
            $table->enum('role', ['clock-in', 'clock-out'])->nullable(false);
            $table->date('login_dt')->nullable(false);
            $table->time('login_time')->nullable(false);
            $table->date('logout_dt')->nullable(true)->default(NULL);
            $table->time('logout_time')->nullable(true)->default(NULL);
            $table->string('slug', 16)->unique()->nullable(false);
            $table->integer('updated_by')->default(0);
            $table->timestamps();
            
            $table->foreign('account_id')->references('id')->on('accounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
