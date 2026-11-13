<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Registration;
use RuntimeException;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // پیدا کردن اولین کاربر دارای نقش Creator
        $creator = Registration::whereHas('roles', function ($query) {
            $query->where('slug', 'creator');
        })->orderBy('id')->first();

        // اگر کاربر Creator وجود نداشت، اجرای Seeder متوقف شود
        if (! $creator) {
            throw new RuntimeException(
                'No user with creator role was found.'
            );
        }

        // دسته‌بندی‌های پیش‌فرض
        $categories = [
            [
                'name' => 'فناوری',
                'slug' => 'technology',
                'description' => 'اخبار و مطالب مرتبط با فناوری',
            ],
            [
                'name' => 'برنامه‌نویسی',
                'slug' => 'programming',
                'description' => 'آموزش و مطالب برنامه‌نویسی',
            ],
            [
                'name' => 'آموزش',
                'slug' => 'education',
                'description' => 'مطالب آموزشی و یادگیری',
            ],
            [
                'name' => 'اخبار',
                'slug' => 'news',
                'description' => 'آخرین اخبار و رویدادها',
            ],
            [
                'name' => 'کسب‌وکار',
                'slug' => 'business',
                'description' => 'مطالب مرتبط با کسب‌وکار و اقتصاد',
            ],
            [
                'name' => 'علمی',
                'slug' => 'science',
                'description' => 'مطالب علمی و پژوهشی',
            ],
            [
                'name' => 'فرهنگ و هنر',
                'slug' => 'culture-art',
                'description' => 'مطالب فرهنگی و هنری',
            ],
            [
                'name' => 'سبک زندگی',
                'slug' => 'lifestyle',
                'description' => 'مطالب مرتبط با سبک زندگی',
            ],
            [
                'name' => 'نقد و بررسی',
                'slug' => 'reviews',
                'description' => 'نقد و بررسی محصولات و موضوعات مختلف',
            ],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['slug' => $category['slug']],
                [
                    'created_by' => $creator->id,
                    'name' => $category['name'],
                    'description' => $category['description'],
                ]
            );
        }
    }
}
