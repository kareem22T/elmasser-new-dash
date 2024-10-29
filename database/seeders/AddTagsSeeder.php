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
            // Generate a unique slug for each tag name
            $slug = MainHelper::slug($oldTag->name);
            $originalSlug = $slug;
            $counter = 1;

            // Check if the slug already exists in the tags table
            while (Tag::where('slug', $slug)->exists()) {
                // If it exists, append a counter to make it unique
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            // Insert data into the new tags table
            Tag::create([
                'id' => $oldTag->id,
                'tag_name' => $oldTag->name,
                'slug' => $slug,
            ]);
        }
    }
}
