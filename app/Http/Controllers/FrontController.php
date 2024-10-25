<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Tag;
use App\Models\Contact;
use App\Models\ArticleComment;
use App\Models\Page;
use App\Models\Category;
use App\Models\User;


class FrontController extends Controller
{

    public function index(Request $request)
    {
        return view('front.index');
    }

    public function comment_post(Request $request)
    {
        if (auth()->check()) {
            $request->validate([
                "content" => "required|min:3|max:10000",
            ]);
            ArticleComment::create([
                'user_id' => auth()->user()->id,
                'article_id' => $request->article_id,
                //'content'=>$request->content,
            ]);
        } else {
            $request->validate([
                'adder_name' => "nullable|min:3|max:190",
                'adder_email' => "nullable|email",
                "content" => "required|min:3|max:10000",
            ]);
            ArticleComment::create([
                'article_id' => $request->article_id,
                'adder_name' => $request->adder_name,
                'adder_email' => $request->adder_email,
                //'content'=>$request->content,
            ]);
        }
        toastr()->success("تم اضافة تعليقك بنجاح وسيظهر للعامة بعد المراجعة");
        return redirect()->back();
    }

    public function contact_post(Request $request)
    {
        $request->validate([
            'name' => "required|min:3|max:190",
            'email' => "nullable|email",
            "phone" => "required|numeric",
            "message" => "required|min:3|max:10000",
        ]);
        if (\MainHelper::recaptcha($request->recaptcha) < 0.8) abort(401);
        Contact::create([
            'user_id' => auth()->check() ? auth()->id() : NULL,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' =>/*"قادم من : ".urldecode(url()->previous())."\n\nالرسالة : ".*/ $request->message
        ]);

        toastr()->success('تم استلام رسالتك بنجاح وسنتواصل معك في أقرب وقت');
        //\Session::flash('message', __("Your Message Has Been Send Successfully And We Will Contact You Soon !"));
        return redirect()->back();
    }

    public function category(Request $request, Category $category, $slug = '')
    {
        if ($category->slug != $slug)
            return redirect()->route('category.show', ['category' => $category->id, 'slug' => $category->slug], 301);
        $articles = Article::where(function ($q) use ($request, $category) {
            $q->where('category_id', $category->id);
            if ($request->user_id != null)
                $q->where('user_id', $request->user_id);
        })->latest()->paginate();
        return view('front.pages.category-articles', compact('articles', 'category'));
    }

    public function categoryRssFeed(Request $request, Category $category, $slug = '')
    {
        if ($category->slug != $slug)
            return redirect()->route('category.show', ['category' => $category->id, 'slug' => $category->slug], 301);

        $articles = Article::where('category_id', $category->id)->latest()->limit(30)->get();
        return response()->view('rss.category', ['articles' => $articles])->header('Content-Type', 'text/xml');
    }

    public function tag(Request $request, Tag $tag, $slug = '')
    {
        if ($tag->slug != $slug)
            return redirect()->route('tag.show', ['tag' => $tag->id, 'slug' => $tag->slug], 301);

        $articles = Article::where(function ($q) use ($request, $tag) {
            if ($request->user_id != null)
                $q->where('user_id', $request->user_id);

            $q->whereHas('tags', function ($q) use ($request, $tag) {
                $q->where('tag_id', $tag->id);
            });
        })->latest()->paginate();

        return view('front.pages.tag-articles', compact('articles', 'tag'));
    }

    public function author(Request $request, User $user)
    {
        $articles = Article::where(function ($q) use ($request, $user) {
            $q->where('user_id', $user->id);
        })->latest()->paginate();
        return view('front.pages.author-articles', compact('articles', 'user'));
    }

    public function article(Request $request, Article $article, $slug = '')
    {
        if ($article->slug != $slug)
            return redirect()->route('article.show', ['article' => $article->id, 'slug' => $article->slug], 301);
        $article->load(['user', 'category', 'tags']);
        $categoryArticles = Article::where(function ($q) use ($request, $article) {
            $q->where('category_id', $article->category_id);
            $q->where('id', '!=', $article->id);
        })->latest()->limit(6)->get();
        $this->views_increase_article($article);
        return view('front.pages.article', compact('article', 'categoryArticles'));
    }

    public function search(Request $request)
    {
        $searchText = strip_tags($request->search_text);
        $articles = Article::with('category')->where(function ($q) use ($searchText) {
            $q->where('title', 'LIKE', '%' . $searchText . '%')->orWhere('slug', 'LIKE', '%' . $searchText . '%');
                //->orWhere('description', 'LIKE', '%' . $searchText . '%');
        })->latest()->paginate();
        return view('front.pages.search-articles', compact('searchText', 'articles'));
    }

    public function page(Request $request, Page $page)
    {
        return view('front.pages.page', compact('page'));
    }

    public function blog(Request $request)
    {
        $articles = Article::where(function ($q) use ($request) {
            if ($request->category_id != null)
                $q->where('category_id', $request->category_id);
            if ($request->user_id != null)
                $q->where('user_id', $request->user_id);
        })->with(['categories', 'tags'])->withCount(['comments' => function ($q) {
            $q->where('reviewed', 1);
        }])->orderBy('id', 'DESC')->paginate();
        return view('front.pages.blog', compact('articles'));
    }

    public function views_increase_article(Article $article)
    {
        $counter = $article->item_seens()->where('type', "ARTICLE")->where('ip', \UserSystemInfoHelper::get_ip())->whereDate('created_at', \Carbon::today())->count();
        if (!$counter) {
            \App\Models\ItemSeen::create([
                'type_id' => $article->id,
                'type' => "ARTICLE",
                'ip' => \UserSystemInfoHelper::get_ip(),
                'prev_link' => \UserSystemInfoHelper::prev_url(),
                'agent_name' => request()->header('User-Agent'),
                'browser' => \UserSystemInfoHelper::get_browsers(),
                'device' => \UserSystemInfoHelper::get_device(),
                'operating_system' => \UserSystemInfoHelper::get_os()
            ]);
            $article->update(['views' => $article->views + 1]);
        }
    }
}

