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
        Schema::create('registrations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke akun login
        
        // Data Diri
        $table->string('nik', 16);
        $table->string('nama_lengkap');
        $table->string('tempat_lahir');
        $table->date('tanggal_lahir');
        $table->string('jenis_kelamin'); // L/P
        $table->text('alamat');
        
        // Data Pendidikan & Ortu
        $table->string('asal_sekolah');
        $table->string('nama_wali');
        $table->string('no_hp_wali');
        
        // Upload Berkas (Menyimpan nama file)
        $table->string('file_kk')->nullable();
        $table->string('file_akta')->nullable();
        $table->string('file_foto')->nullable();
        
        // Status Pendaftaran
        $table->enum('status', ['menunggu', 'diterima', 'ditolak'])->default('menunggu');
        $table->text('catatan_admin')->nullable(); // Jika ditolak alasannya apa
        
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
