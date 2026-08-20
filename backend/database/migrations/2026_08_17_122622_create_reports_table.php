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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('vehicle_id')->constrained('vehicles')->cascadeOnDelete();

            $table->enum('reason', [
                'fraud',
                'incorrect_information',
                'inappropriate_content',
                'duplicate_listing',
                'vehicle_not_available',
                'other',
            ]);

            $table->text('reason_description')->nullable();
            $table->string('evidence')->nullable();

            $table->enum('status', [
                'pending',
                'reviewed',
                'resolved',
                'rejected',
            ])->default('pending');

            $table->timestamps();

            $table->unique(['user_id', 'vehicle_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
