<?php

namespace Database\Seeders;

use App\Models\Blog;
# use Illuminate\Support\Facades\DB;
# use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
# use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Blog::factory()->count(10)->create();
    }
}
