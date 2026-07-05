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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
             // Property Information
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();

            // Relationships
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('property_type_id')->constrained('property_types')->cascadeOnDelete();
            $table->foreignId('city_id')->constrained('cities')->cascadeOnDelete();

            // Address
            $table->string('district')->nullable();
            $table->string('neighborhood')->nullable();
            $table->text('address');

            // Property Details
            $table->enum('purpose', ['sale', 'rent']);
            $table->decimal('price', 12, 2);
            $table->integer('area_size'); // Square Meter (m²)

            $table->unsignedTinyInteger('bedrooms')->nullable();
            $table->unsignedTinyInteger('bathrooms')->nullable();

            $table->boolean('parking')->default(false);

            // Status
            $table->enum('status', [
                'available',
                'sold',
                'rented'
            ])->default('available');

            $table->boolean('featured')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
