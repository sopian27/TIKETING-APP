<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     public function up(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->integer('is_spam')
                  ->default(0)
                  ->after('status');

            $table->string('prioritas', 30)
                  ->nullable()
                  ->after('is_spam');
        });
    }

    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn(['is_spam', 'prioritas']);
        });
    }
};
