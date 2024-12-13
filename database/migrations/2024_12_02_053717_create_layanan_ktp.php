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
        Schema::create('layanan_ktp', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users")->cascadeOnUpdate();
            $table->string("namalengkap");
            $table->string("nik")->nullable();
            $table->string("kewarganegaraan");
            $table->enum("jeniskelamin", ["laki", "perempuan"]);
            $table->string("tempatlahir");
            $table->string("tanggallahir");
            $table->string("agama");
            $table->string("alamat");
            $table->string("pekerjaan");
            $table->string("statuskawin");
            $table->string("files");
            $table->string("message")->nullable();
            $table->enum("status", ["sending", "pending", "rejected", "done"])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan_ktp');
    }
};
