<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Requests\News\StoreRequest;
use App\Http\Requests\News\UpdateRequest;

class NewsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('news-index');
        $news = News::where('user_id', auth()->user()->id)->latest()->paginate(10);
        return view('news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('news-create');
        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        //$this->authorize('news-create');
        $news = new News();
        $news->title = $request->title;
        $news->description = $request->description;
        $news->user_id = auth()->user()->id;
        $news->save();
        return redirect()->route('news.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        $this->authorize('news-show');
        return view('news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        //$this->authorize('news-edit', $news);
        $this->authorize('news-edit');
        return view('news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, News $news)
    {
        //$this->authorize('news-update', $news);

        $news->title = $request->title;
        $news->description = $request->description;
        $news->save();

        return redirect()->route('news.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        //$this->authorize('news-destroy', $news);
        $this->authorize('news-destroy');
        $news->delete();
        return redirect()->route('news.index');
    }


    /**
     * Show the news search.
     *
     * @param Request $request
     * @return void
     */
    public function search(Request $request)
    {
        $search = filter_var($request->search, FILTER_SANITIZE_SPECIAL_CHARS);

        $news = News::join('users', 'news.user_id','=','users.id')
            ->where('news.title', 'like', '%' . $search . '%')
            ->Where('users.id', auth()->user()->id)
            ->orderByDesc('news.id')
            ->paginate(10);
        return view('news.index', compact('news', 'search'));
    }
}
