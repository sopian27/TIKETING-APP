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
        Schema::table('tickets', function (Blueprint $table) {
            // 1️⃣ hapus kolom lama
            $table->dropColumn('images');
        });

        Schema::table('tickets', function (Blueprint $table) {
            // 2️⃣ buat ulang sebagai JSON
            $table->json('images')->nullable()->after('message');
        });
    }

    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('images');
        });

        Schema::table('tickets', function (Blueprint $table) {
            $table->longText('images')->nullable();
        });
    }
};
