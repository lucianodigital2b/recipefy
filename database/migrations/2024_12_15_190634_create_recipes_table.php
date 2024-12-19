<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('slug', 255);
            $table->string('thumbnail', 255)->nullable();
            $table->integer('status')->default(1)->comment('1 = Published, 0 = Draft');
            $table->longText('description');
            $table->decimal('servings', 18, 2);
            $table->integer('prep_time');
            $table->integer('upvotes')->default(0);
            $table->integer('downvotes')->default(0);
            $table->integer('favorites')->default(0);
            $table->integer('prep_time_type')->comment('1 = minutes, 2 = hours, 3 = days');
            $table->foreignId('created_by')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
