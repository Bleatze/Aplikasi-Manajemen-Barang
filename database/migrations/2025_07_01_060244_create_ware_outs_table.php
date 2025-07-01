<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ware_outs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ware_id')->constrained('wares')->onDelete('cascade');
            $table->integer('amount');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ware_outs');
    }
};
