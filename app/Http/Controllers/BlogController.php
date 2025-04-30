<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $cari = $request->cari;
        $blogs = DB::table('blogs')
            ->where("title", "LIKE", "%".$cari."%")
            ->paginate(5);
        return view('blog.index', compact('blogs', 'cari'));
    }
}