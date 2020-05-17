<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $news = News::latest()->paginate(10);
        //$news = News::where('user_id', auth()->user()->id)->get();
        return view('home', compact('news'));
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
            ->orWhere('users.name', 'like', '%' . $search . '%')
            ->orWhere('users.email', 'like', '%' . $search . '%')
            ->orderByDesc('news.id')
            ->paginate(10);
        return view('home', compact('news', 'search'));
    }

    /**
     * Function debug environment in Local
     *
     * @return void
     */
    public function debug()
    {
        $user = auth()->user();
        echo "Name: {$user->name} <br>";
        echo "Email: {$user->email} <br>";
        echo "TimeZone: {$user->timezone}<br>";
        echo "<hr><h3>Roles</h3>";
        foreach ($user->role as $role) {
            echo "Name: {$role->name}  - Label: {$role->label} <br>";
            echo "<ul>";
            foreach ($role->permission as $permission) {
                echo "<li>{$permission->name} </li>";
            }
            echo "</ul>";
            echo "<hr>";
        }
    }
}
