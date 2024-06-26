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
        Schema::create('lanches', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->references("id")->on("users")->cascadeOnDelete();
            $table->string('name')->nullable(false);
            $table->text("description")->nullable(false);
            $table->float("price")->nullable(false);
            $table->integer("quantity", false, true)->nullable(false);
            $table->string("image_url", 255)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("lanches", function (Blueprint $table) {
            $table->dropForeign("user_id");
        });

        Schema::dropIfExists('lanches');
    }
};
