<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('location');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('sport_type');
            $table->boolean('is_accessible_mobility')->default(false);
            $table->boolean('is_accessible_vision')->default(false);
            $table->boolean('is_accessible_hearing')->default(false);
            $table->boolean('is_accessible_cognitive')->default(false);
            $table->string('accessibility_details')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('organizer');
            $table->integer('max_participants')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('activities');
    }
};
