<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('discount_conditions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('discount_rule_id')->constrained('discount_rules')->onDelete('cascade');
            $table->string('condition_key'); // Koşul anahtarı (örneğin: 'min_quantity', 'category_id')
            $table->string('condition_value'); // Koşul değeri (örneğin: '2', '6', '1000')
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('discount_conditions');
    }
};