<?php

use App\Models\Tag;
use Illuminate\Support\Facades\Log;
function assignTagsToArticle($article, $tags)
{
    $tagsIdsArray = [];
    foreach ($tags as $tag) {
        // Check if the tag slug exists in the database
        $existingTag = Tag::where('slug', \MainHelper::slug($tag))->first();

        if ($existingTag) {
            // If tag exists, increment a counter or perform desired action
            // For example, you can increment a counter or handle the logic as needed
            // Example: incrementing the tag's usage count or handling as needed
            $existingTag->increment('usage_count'); // This assumes you have a usage_count column
            $tagsIdsArray[] = $existingTag->id;
        } else {
            $tagsIdsArray = [];
            foreach ($tags as $tag) {
                $isTag = Tag::find($tag);
                if ($isTag)
                    $tagsIdsArray[] = $isTag->id;
                else {
                    $tagRecord = Tag::create(
                        ['tag_name' => $tag],
                        ['slug' => \MainHelper::slug($tag)]
                    );
                    $tagsIdsArray[] = $tagRecord->id;
                }
            }
        }
    }
    // Sync tags to the article
    $article->tags()->sync($tagsIdsArray);

    return true;
}

function redirectCategoryRoute($category)
{
    return $category ? route('category.show', ['category' => $category->id, 'slug' => $category->slug]) : '';
}

function redirectArticleRoute($article)
{
    return route('article.show', ['article' => $article->id, 'slug' => $article->slug]);
}

function redirectTagRoute($tag)
{
    return route('tag.show', ['tag' => $tag->id, 'slug' => $tag->slug]);
}



