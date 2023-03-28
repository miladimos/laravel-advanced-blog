<?php

namespace App\Http\Controllers\Site;

use App\Models\Faq;
use App\Models\Tag;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;

class SiteController extends Controller
{
    public function index()
    {
//        auth()->loginUsingId(1);

        // auth()->logout();

        $this->seo()->setTitle('Blogging ...');

        $categories = Category::withCount('articles')->get();

        return view('site.index', compact('categories'));
    }

    public function user(User $user)
    {
        $this->seo()->setTitle($user->label);

        $articles = $user->articles()->latest()->paginate(24);
        $categories = Category::withCount('articles')->get();

        return view('site.blog.author', compact('user','articles', 'categories'));
    }

    public function aboutUs()
    {
        $this->seo()->setTitle('about us');

        return view('site.pages.about');
    }

    public function contactUs()
    {
        $this->seo()->setTitle('contact us');

        return view('site.pages.contact');
    }

    public function tag(Tag $tag)
    {
        $this->seo()->setTitle('by tag' . $tag->name);

        return view('site.blog.tag', compact('tags'));
    }

    public function tags()
    {
        $this->seo()->setTitle('tags');

        return view('site.pages.tags', compact('tags'));
    }

    public function authors()
    {
        $this->seo()->setTitle('authors');

        $authors = User::latest()->paginate(24);
        return view('site.pages.authors', compact('authors'));
    }

    public function search()
    {
        $this->seo()->setTitle('search');

        $query = trim(request()->get('q'));

        $Articles = Article::where('title' , 'like', "%$query%")->latest()->paginate(24);

        return view('site.pages.search', compact('Articles'));
    }

    public function category(Category $category)
    {
        $this->seo()->setTitle('by category' . $category->name);

        return view('site.blog.category', compact('category'));
    }

    public function categories()
    {
        $this->seo()->setTitle('categories');

        return view('site.pages.categories', compact('categories'));
    }

    public function faqs()
    {
        $this->seo()->setTitle('faqs');

        $faqs = Faq::latest()->get();

        return view('site.pages.faqs', compact('faqs'));
    }
}
