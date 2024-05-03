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
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->decimal('price', 8, 2);
            $table->string('image')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        DB::table('dishes')->insert([
            [
                'name' => 'Nachos con Queso',
                'type' => 'appetizer',
                'price' => 10.99,
                'image' => 'ruta/de/la/imagen.jpg'
            ],
            [
                'name' => 'Aros de Cebolla Crujientes',
                'type' => 'appetizer',
                'price' => 8.99,
                'image' => 'ruta/de/la/imagen.jpg'
            ],
            [
                'name' => 'Pollo a la Parrilla con Verduras',
                'type' => 'main_course',
                'price' => 16.99,
                'image' => 'ruta/de/la/imagen.jpg'
            ],
            [
                'name' => 'Pasta Carbonara',
                'type' => 'main_course',
                'price' => 14.99,
                'image' => 'ruta/de/la/imagen.jpg'
            ],
            [
                'name' => 'Sándwich Club',
                'type' => 'main_course',
                'price' => 12.99,
                'image' => 'ruta/de/la/imagen.jpg'
            ],
            [
                'name' => 'Salmón a la Parrilla',
                'type' => 'main_course',
                'price' => 15.99,
                'image' => 'ruta/de/la/imagen.jpg'
            ],
            [
                'name' => 'Helado Sundae',
                'type' => 'dessert',
                'price' => 6.99,
                'image' => 'ruta/de/la/imagen.jpg'
            ],
            [
                'name' => 'Tarta de Limón',
                'type' => 'dessert',
                'price' => 7.99,
                'image' => 'ruta/de/la/imagen.jpg'
            ],
            [
                'name' => 'Ceviche de Camarón',
                'type' => 'appetizer',
                'price' => 12.99,
                'image' => 'ruta/de/la/imagen.jpg'
            ],
            [
                'name' => 'Lomo Saltado',
                'type' => 'main_course',
                'price' => 18.99,
                'image' => 'ruta/de/la/imagen.jpg'
            ],
            [
                'name' => 'Arroz con Mariscos',
                'type' => 'main_course',
                'price' => 20.99,
                'image' => 'ruta/de/la/imagen.jpg'
            ],
            [
                'name' => 'Tacos de Carnitas',
                'type' => 'main_course',
                'price' => 14.99,
                'image' => 'ruta/de/la/imagen.jpg'
            ],
            [
                'name' => 'Pastel de Chocolate',
                'type' => 'dessert',
                'price' => 8.99,
                'image' => 'ruta/de/la/imagen.jpg'
            ],
            [
                'name' => 'Flan de Vainilla',
                'type' => 'dessert',
                'price' => 7.99,
                'image' => 'ruta/de/la/imagen.jpg'
            ],
        ]);
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dishes');
    }
};
