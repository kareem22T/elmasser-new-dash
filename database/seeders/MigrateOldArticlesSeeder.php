<?php
namespace Database\Seeders;
ini_set('memory_limit', '512M');
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Article;
use Illuminate\Support\Str;

class MigrateOldArticlesSeeder extends Seeder
{
    public function run()
    {
        // Fetch articles from old database connection (if using a different connection)
        $oldArticles = DB::connection('old_database')->table('articles')->get();

        foreach ($oldArticles as $oldArticle) {
            // Process the data if needed, e.g., combine 'intro' and 'content' into 'description'
            $description = $oldArticle->content;

            // Insert data into new articles table
            Article::create([
                'title' => $oldArticle->title,
                'slug' => Str::slug($oldArticle->title),
                'description' => $description,
                'main_image' => $oldArticle->thumbnail_path,
                'main_image_title' => $oldArticle->thumbnail_title,
                'meta_description' => $oldArticle->meta_description ?? $oldArticle->intro,
                'is_urgent' => 0,
                'is_featured' => 0,
                'is_trend' => $oldArticle->isTrend,
                'views' => $oldArticle->views ?? 0,  // Assuming views might be 0 if not present
                'category_id' => $oldArticle->category_id,
                'user_id' => $oldArticle->author_id,
                'created_at' => $oldArticle->created_at,
                'updated_at' => $oldArticle->updated_at,
            ]);
        }
    }
}
