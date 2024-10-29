<?php

namespace Database\Seeders;

use App\Helpers\MainHelper;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Fetch tags from the old database connection
        $oldTags = DB::connection('old_database')->table('tags')->get();

        foreach ($oldTags as $oldTag) {
            // Ensure unique tag name
            $tagName = $oldTag->name;
            $originalName = $tagName;
            $nameCounter = 1;

            while (Tag::where('tag_name', $tagName)->exists()) {
                $tagName = $originalName . ' ' . $nameCounter;
                $nameCounter++;
            }

            // Generate a unique slug for each tag name
            $slug = MainHelper::slug($tagName);
            $originalSlug = $slug;
            $slugCounter = 1;

            while (Tag::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $slugCounter;
                $slugCounter++;
            }

            // Insert data into the new tags table
            Tag::create([
                'id' => $oldTag->id,
                'tag_name' => $tagName,
                'slug' => $slug,
            ]);
        }
    }
}
