<?php
declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UnitSeeder::class,
            UserSeeder::class,
            TagsSeeder::class,
            ArticlesSeeder::class,
            ArticleTagsSeeder::class,
            ArticleImagesSeeder::class,
            CommentsSeeder::class,
            InventoryCategoriesSeeder::class,
            InventorySeeder::class,
            ManagementSeeder::class,
        ]);
    }
}
