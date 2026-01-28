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
        Schema::create('sea_weather', function (Blueprint $table) {
            $table->id();
            $table->string('location');   // Ví dụ: Hoàng Sa, Trường Sa
        $table->float('temp');        // Nhiệt độ
        $table->string('wind');       // Cấp gió
        $table->float('wave');        // Độ cao sóng
        $table->string('status');     // Trạng thái: Bình thường, Biển động
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sea_weather');
    }
};
