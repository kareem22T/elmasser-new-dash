<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            [
                "tag_name" => "إدارة البريد الإلكتروني",
                "slug" => "email-handling",
            ],
            [
                "tag_name" => "الفوتوشوب",
                "slug" => "photoshop",
            ],
            [
                "tag_name" => "العربية",
                "slug" => "arabic",
            ],
            [
                "tag_name" => "الإنجليزية",
                "slug" => "english",
            ],
            [
                "tag_name" => "تصميم الفوتوشوب",
                "slug" => "photoshop-design",
            ],
            [
                "tag_name" => "Illustrator",
                "slug" => "illustrator",
            ],
            [
                "tag_name" => "Microsoft Word",
                "slug" => "microsoft-word",
            ],
        
            [
                "tag_name" => "التعليم والتدريس الخصوصي",
                "slug" => "education-tutoring",
            ],
            [
                "tag_name" => "تصميم الملصقات",
                "slug" => "label-design",
            ],
        ];
        //\App\Models\Tag::truncate();
        \App\Models\Tag::insert( collect($tags)->unique('slug')->all() );

    }
}
