<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBirdsTable extends Migration
{
  private const BIRDS_TABLE='birds';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::BIRDS_TABLE, function (Blueprint $table) {
            $table->bigIncrements('bird_id')->unique();
            $table->foreignId('user_id')->constrained('UserEloquent')->onDelete('cascade');
            $table->date('observed_on')->now();
            $table->string('observed_in');
            $table->string('species');
            $table->string('scientific_name');
            $table->string('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(self::BIRDS_TABLE);
    }
}
