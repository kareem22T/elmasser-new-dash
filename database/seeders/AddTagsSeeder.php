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
        // Fetch tags from old database connection (if using a different connection)
        $oldTags = DB::connection('old_database')->table('tags')->get();

        foreach ($oldTags as $oldTag) {
            // Create a slug for the tag name
            $slug = MainHelper::slug($oldTag->name);

            // Insert data into new tags table
            Tag::create([
                'id' => $oldTag->id,
                'tag_name' => $oldTag->name,
                'slug' => $slug,
            ]);
        }
    }
}
