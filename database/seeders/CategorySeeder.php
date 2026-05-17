<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // === Главные категории ===

        $home = Category::updateOrCreate(
            ['slug' => 'home-repair'], // По какому полю искать уникальность
            ['name' => 'Все для дома, офиса', 'popular' => true] // Что обновить/добавить
        );

        $transport = Category::updateOrCreate(
            ['slug' => 'transport-logistics'],
            ['name' => 'Транспорт и логистика', 'popular' => true]
        );

        $construction = Category::updateOrCreate(
            ['slug' => 'construction'],
            ['name' => 'Строительство', 'popular' => true]
        );

        $autoservice = Category::updateOrCreate(
            ['slug' => 'autoservice'],
            ['name' => 'Автоуслуги', 'popular' => true]
        );

        $finance = Category::updateOrCreate(
            ['slug' => 'finance'],
            ['name' => 'Бизнес и финансы', 'popular' => true]
        );

        $digital = Category::updateOrCreate(
            ['slug' => 'digital'],
            ['name' => 'IT и digital', 'popular' => true]
        );

        $photo = Category::updateOrCreate(
            ['slug' => 'photo'],
            ['name' => 'Фото и видео', 'popular' => true]
        );

        $education = Category::updateOrCreate(
            ['slug' => 'education'],
            ['name' => 'Образование', 'popular' => true]
        );

        $repair = Category::updateOrCreate(
            ['slug' => 'repair'],
            ['name' => 'Бытовые услуги', 'popular' => true]
        );


        // === Подкатегории ===
        Category::updateOrCreate(
            ['slug' => 'electrician'],
            ['name' => 'Электрик', 'parent_id' => $home->id]
        );

        Category::updateOrCreate(
            ['slug' => 'plumber'],
            ['name' => 'Сантехник', 'parent_id' => $home->id]
        );

        Category::updateOrCreate(
            ['slug' => 'cleaning'],
            ['name' => 'Клининг', 'parent_id' => $home->id]
        );

        Category::updateOrCreate(
            ['slug' => 'furniture'],
            ['name' => 'Изготовление мебели, сборка мебели', 'parent_id' => $home->id]
        );

        Category::updateOrCreate(
            ['slug' => 'remont'],
            ['name' => 'Ремонт квартир, офиса', 'parent_id' => $home->id]
        );

        Category::updateOrCreate(
            ['slug' => 'passanger-services'],
            ['name' => 'Услуги транспортировки', 'parent_id' => $transport->id]
        );

        Category::updateOrCreate(
            ['slug' => 'cargo-transport'],
            ['name' => 'Грузоперевозки', 'parent_id' => $transport->id]
        );

        Category::updateOrCreate(
            ['slug' => 'accounting'],
            ['name' => 'Бухгалтерские', 'parent_id' => $finance->id]
        );
    }
}
