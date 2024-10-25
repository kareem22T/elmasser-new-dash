<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MigrateCategories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Fetch categories from old database connection (if using a different connection)
        $oldCategories = [
            (object)[
                'title' => 'اخبار',
                'meta_description' => 'أخبار عامة',
                'slug' => 'news',
                'keywords' => 'احدث اخبار مصر, اهم اخبار مصر',
                'is_main' => 1,
                'color' => '#ffffff'
            ],
            (object)[
                'title' => 'بث مباشر',
                'meta_description' => 'بث مباشر للأحداث',
                'slug' => 'live-stream',
                'keywords' => 'بث مباشر, أخبار حية, أحداث حية',
                'is_main' => 1,
                'color' => '#ffff00'
            ],
            (object)[
                'title' => 'رياضة',
                'meta_description' => 'أخبار رياضية',
                'slug' => 'sports',
                'keywords' => 'جديد اخبار الرياضة, اهم اخبار الرياضة',
                'is_main' => 1,
                'color' => '#00ff00'
            ],
            (object)[
                'title' => 'حوادث',
                'meta_description' => 'أخبار حوادث',
                'slug' => 'accidents',
                'keywords' => 'جديد اخبار الحوادث, اهم اخبار الحوادث',
                'is_main' => 1,
                'color' => '#ff0000'
            ],
            (object)[
                'title' => 'فنون',
                'meta_description' => 'أخبار فنون',
                'slug' => 'art-news',
                'keywords' => 'جديد اخبار الفن, اهم اخبار الفن',
                'is_main' => 1,
                'color' => '#ff00ff'
            ],
            (object)[
                'title' => 'عربي ودولي',
                'meta_description' => 'أخبار عربية ودولية',
                'slug' => 'world-news',
                'keywords' => 'جديد الاخبار العربية والدولية, اهم الاخبار العربية والدولية',
                'is_main' => 0,
                'color' => '#0000ff'
            ],
            (object)[
                'title' => 'محافظات',
                'meta_description' => 'أخبار محافظات',
                'slug' => 'governorates',
                'keywords' => 'أخبار المحافظات, أخبار محلية, محليات',
                'is_main' => 0,
                'color' => '#00ffff'
            ],
            (object)[
                'title' => 'فيديو المصير',
                'meta_description' => 'فيديوهات المصير',
                'slug' => 'videos',
                'keywords' => 'مصر الان تي في منصة مصر الان للفيديوهات والاخبار المصورة',
                'is_main' => 0,
                'color' => '#ff8000'
            ],
            (object)[
                'title' => 'تقارير وتحقيقات',
                'meta_description' => 'تقارير وتحقيقات متنوعة',
                'slug' => 'investigations',
                'keywords' => 'اهم التحقيقات, جديد التحقيقات',
                'is_main' => 0,
                'color' => '#808080'
            ],
            (object)[
                'title' => 'اقتصاد',
                'meta_description' => 'أخبار اقتصادية',
                'slug' => 'economy',
                'keywords' => 'جديد اخبار الاقتصاد والبنوك, اهم اخبار الاقتصاد والبنوك',
                'is_main' => 0,
                'color' => '#008080'
            ],
            (object)[
                'title' => 'منوعات',
                'meta_description' => 'أخبار منوعة',
                'slug' => 'miscellaneous',
                'keywords' => 'أخبار منوعة, متفرقات, مواضيع متنوعة',
                'is_main' => 0,
                'color' => '#800080'
            ],
            (object)[
                'title' => 'مرأة',
                'meta_description' => 'أخبار نسائية',
                'slug' => 'woman-and-child',
                'keywords' => 'جديد المرأة والطفل, اهم اخبار المرأة والطفل',
                'is_main' => 0,
                'color' => '#ff0080'
            ],
            (object)[
                'title' => 'صور اليوم',
                'meta_description' => 'أخبار اليوم بالصور',
                'slug' => 'today-in-pictures',
                'keywords' => 'صور اليوم, صور حية, اخبار اليوم',
                'is_main' => 1,
                'color' => '#808000'
            ],
            (object)[
                'title' => 'سيارات',
                'meta_description' => 'أخبار السيارات',
                'slug' => 'cars',
                'keywords' => 'أخبار السيارات, اخبار المركبات, جديد السيارات',
                'is_main' => 0,
                'color' => '#800000'
            ],
            (object)[
                'title' => 'دنيا ودين',
                'meta_description' => 'أخبار دينية ودنيا',
                'slug' => 'religion-and-life',
                'keywords' => 'أخبار دينية, دنيا ودين, اسلاميات',
                'is_main' => 0,
                'color' => '#008000'
            ],
            (object)[
                'title' => 'تكنولوجيا',
                'meta_description' => 'أخبار تكنولوجيا',
                'slug' => 'technology',
                'keywords' => 'تكنولوجيا, تقنيات حديثة, اخبار التكنولوجيا',
                'is_main' => 0,
                'color' => '#ff8080'
            ],
            (object)[
                'title' => 'المقالات',
                'meta_description' => 'مقالات تحليلية',
                'slug' => 'articles',
                'keywords' => 'مقالات, تحليل, رأي',
                'is_main' => 0,
                'color' => '#c0c0c0'
            ]
        ];


        foreach ($oldCategories as $oldCategory) {
            // Insert data into new categories table
            Category::create([
                'title' => $oldCategory->title,
                'meta_description' => $oldCategory->meta_description,
                'slug' => $oldCategory->slug,
                'meta_keywords' => $oldCategory->keywords,
                'is_at_home' => $oldCategory->is_main,
                'color' => $oldCategory->color,
                'user_id' => 1,
            ]);
        }
    }
}
