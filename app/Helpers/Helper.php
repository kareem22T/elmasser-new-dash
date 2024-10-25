<?php

use App\Models\Tag;
use Illuminate\Support\Facades\Log;

function assignTagsToArticle($article, $tags)
{
    $tagsIdsArray = [];
    foreach ($tags as $tag) {
        $tagsIdsArray[] = Tag::firstOrCreate(['id' => $tag], ['tag_name' => $tag, 'slug' => \MainHelper::slug($tag)])->id;
    }
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



