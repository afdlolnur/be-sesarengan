<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();

            $table->varchar('complaint_number')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('picture_path')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('district')->nullable();
            $table->string('is_public')->nullable();
            $table->string('is_anon')->nullable();
            $table->string('caption')->nullable();
            $table->string('status')->default('PENDING');
            
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
        Schema::dropIfExists('complaints');
    }
}
