<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Blog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Chạy lệnh php artisan db:seed
        // $this->call(GroupSeeder::class);

        Blog::factory(100)->create();
    }
}
