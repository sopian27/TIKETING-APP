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
            
            $table->float('spam_confidence')
                ->nullable()
                ->comment('Confidence score from text model');

            $table->boolean('image_relevant')
                ->nullable()
                ->comment('Whether image is relevant to text');

            $table->float('relevance_score')
                ->nullable()
                ->comment('Image-text relevance score');

            $table->longText('ml_response')
                ->nullable()
                ->comment('Raw ML response JSON');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
              $table->dropColumn([
                'is_spam',
                'prioritas',
                'spam_confidence',
                'image_relevant',
                'relevance_score',
                'ml_response',
            ]);
        });
    }
};
