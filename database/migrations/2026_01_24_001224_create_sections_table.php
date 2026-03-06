<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('sections', function (Blueprint $table) {
        $table->id();
        $table->string('key')->unique(); // ID unik: 'sambutan', 'visi_misi'
        $table->string('title');
        $table->text('content')->nullable();
        $table->string('image')->nullable(); // Foto pengasuh atau background
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
