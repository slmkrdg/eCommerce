<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('discount_rules', function (Blueprint $table) {
            $table->id();
            $table->string('rule_name'); // Kural adı
            $table->string('discount_reason'); // Kural kodu
            $table->string('rule_class'); // Kural sınıfı
            $table->string('rule_type'); // Kural tipi (örneğin 'percentage', 'fixed', 'free_item')
            $table->decimal('value', 8, 2); // İndirim değeri (yüzde veya sabit miktar)
            $table->json('conditions')->nullable(); // Kuralın koşulları (örneğin 'total_amount', 'category_id', vb.)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('discount_rules');
    }
};