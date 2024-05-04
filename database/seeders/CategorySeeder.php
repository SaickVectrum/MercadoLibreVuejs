<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{

	public function run()
	{
		Category::create(['name' => 'Carros']);
		Category::create(['name' => 'Celulares']);
		Category::create(['name' => 'Electrodomesticos']);
		Category::create(['name' => 'Herramientas']);
		Category::create(['name' => 'Ropa']);
		Category::create(['name' => 'Deportes']);
		Category::create(['name' => 'Hogar']);
		Category::create(['name' => 'Computación']);
		Category::create(['name' => 'Inmuebles']);
		Category::create(['name' => 'Oficina']);
		Category::create(['name' => 'Juguetes']);
		Category::create(['name' => 'Libros']);
	}
}
