<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // supprimer la table existante et la recréer afin deviter les erreurs lors de la migration
        Schema::dropIfExists('activities');

        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('link')->nullable();
            $table->string('location')->nullable();
            $table->date('date');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('sport_type')->nullable();
            $table->boolean('is_accessible_mobility')->default(false);
            $table->boolean('is_accessible_vision')->default(false);
            $table->boolean('is_accessible_hearing')->default(false);
            $table->boolean('is_accessible_cognitive')->default(false);
            $table->string('accessibility_details')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('activities');
    }
};
