<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('technical_descriptions', function (Blueprint $table) {
            $table->id();
            $table->text('Description');
            $table->text('Recommendations');
            $table->string('ref_no');
            $table->integer('ticket_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technical_descriptions');
    }
};
