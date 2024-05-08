<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->integer('capacity');
            $table->integer('number');
            $table->softDeletes();
            $table->timestamps();
        });

        DB::table('tables')->insert([
            ['capacity' => 4, 'number' => 1],
            ['capacity' => 4, 'number' => 2],
            ['capacity' => 4, 'number' => 3],
            ['capacity' => 4, 'number' => 4],
            ['capacity' => 4, 'number' => 5],
            ['capacity' => 4, 'number' => 6],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tables');
    }
};
