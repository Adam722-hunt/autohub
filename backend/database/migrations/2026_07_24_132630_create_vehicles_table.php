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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->foreignId('vehicle_type_id')->constrained()->restrictOnDelete();
            $table->foreignId('brand_id')->constrained()->restrictOnDelete();
            $table->foreignId('model_id')->constrained('vehicle_models')->restrictOnDelete();
            $table->foreignId('vehicle_generation_id')->nullable()->constrained()->nullOnDelete();
            $table->year('year');
            
            $table->foreignId('country_id')->constrained()->restrictOnDelete();
            $table->foreignId('city_id')->constrained()->restrictOnDelete();
            
            $table->foreignId('fuel_type_id')->constrained()->restrictOnDelete();
            $table->foreignId('transmission_id')->constrained()->restrictOnDelete();
            $table->foreignId('drivetrain_id')->constrained()->restrictOnDelete();
            $table->foreignId('body_type_id')->constrained()->restrictOnDelete();
            
            $table->unsignedSmallInteger('engine_displacement')->nullable()->comment('cc');
            $table->foreignId('aspiration_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('engine_layout_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('engine_cylinder_id')->nullable()->constrained()->nullOnDelete();
            
            $table->unsignedInteger('mileage')->default(0);
            $table->foreignId('condition_id')->constrained()->restrictOnDelete();
            $table->foreignId('color_id')->constrained()->restrictOnDelete();
            
            $table->string('title');
            $table->text('description');
            $table->decimal('price', 12, 2);
            $table->foreignId('currency_id')->constrained()->restrictOnDelete();



            $table->unsignedSmallInteger('horsepower')->nullable();
            $table->unsignedSmallInteger('torque')->nullable()->comment('Nm');


            $table->boolean('negotiable')->default(false);

            $table->enum('status', [
                'draft',
                'active',
                'reserved',
                'sold',
                'archived',
                'rejected',
                'pending'
            ])->default('pending');

            $table->unsignedInteger('views')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};