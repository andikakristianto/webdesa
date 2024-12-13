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
        Schema::create('layanan_akte', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users")->cascadeOnUpdate();
            $table->string("nama");
            $table->string("kk")->nullable();
            $table->string("nik")->nullable();
            $table->enum("jeniskelamin", ["laki", "perempuan"]);
            $table->string("tempatlahir");
            $table->string("agama");
            $table->string("tanggallahir");
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
        Schema::dropIfExists('layanan');
    }
};
