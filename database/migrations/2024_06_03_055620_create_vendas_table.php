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
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->references("id")->on("users")->cascadeOnDelete();
            $table->foreignId("lanche_id")->references("id")->on("lanches")->cascadeOnDelete();
            $table->unsignedInteger("quantity")->nullable(false);
            $table->float("total_price")->nullable(false);
            $table->timestamp("date")->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("vendas", function (Blueprint $table) {
            $table->dropForeign("user_id");
            $table->dropForeign("lanche_id");
        });

        Schema::dropIfExists('vendas');
    }
};
