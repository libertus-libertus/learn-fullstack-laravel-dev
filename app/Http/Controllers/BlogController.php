<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Menampilkan seluruh dari tabel
    */
    public function index(Request $request)
    {
        $cari = $request->cari;
        $blogs = Blog::where("title", "LIKE", "%".$cari."%")
            ->withTrashed()
            ->orderBy("id", "DESC")
            ->paginate(5);
        return view("blog.index", compact("blogs", "cari"));
    }

    /**
     * Menampilkan form create
    */
    public function create()
    {
        $tags = Tag::all(); 
        return view("blog.create", compact("tags"));
    }

    /**
     * Menyimpan data
    */ 
    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|unique:blogs,title|max:255",
            "description" => "required"
        ],[
            "title.required" => "Judul tidak boleh kosong",
            "description.required" => "Deskripsi tidak boleh kosong",
        ]);

        $title = $request->title; // 365Scores

        $blog = Blog::create([
            "title" => $title,
            "slug" => Str::slug($title),
            "description" => $request->description
        ]);
        $blog->tags()->attach($request->tags);

        Session::flash("success", "Berita berhasil disimpan!");
        return redirect()->route("blog.index");
    }

    /**
     * Menampilkan data berdasarkan id
    */
    public function show($id) 
    {
        $blog = Blog::with(["comments", "tags"])->findOrFail($id);
        if (!$blog) {
            abort(404);
        }
        return view("blog.show", compact("blog"));
    }

    /**
     * Menampilkan data berdasarkan id
    */
    public function edit($id)
    {
        $tags = Tag::all();
        $blog = Blog::with(["tags"])->findOrFail($id);
        if (!$blog) {
            abort(404);
        }
        return view("blog.edit", compact("blog", "tags"));
    }

    /**
     * Mengupdate data
    */
    public function update(Request $request, $id)
    {
        $request->validate([
            "title" => "required|unique:blogs,title, ".$id."|max:255",
            "description" => "required"
        ], [
            "title.required" => "Judul tidak boleh kosong",
            "description.required" => "Deskripsi tidak boleh kosong"
        ]);

        $blog = Blog::findOrFail($id);

        // Update tags
        $blog->tags()->sync($request->tags);

        $title = $request->title;
        $blog->update([
            "title" => $title,
            "slug" => Str::slug($title),
            "description" => $request->description
        ]);

        Session::flash("success", "Berita berhasil diupdate!");
        return redirect()->route("blog.index");
    }

    /**
     * Menghapus data
    */   
    public function destroy($id) 
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        Session::flash("success", "Berita berhasil dihapus!");
        return redirect()->route("blog.index", compact("blog"));
    }

    public function restore($id)
    {
        $blog = Blog::withTrashed()->findOrFail($id);
        $blog->restore();

        Session::flash("success", "Berita berhasil direstore!");
        return redirect()->back();
    }
}