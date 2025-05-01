<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
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
        $blogs = DB::table("blogs")
            ->where("title", "LIKE", "%".$cari."%")
            ->paginate(5);
        return view("blog.index", compact("blogs", "cari"));
    }

    /**
     * Menampilkan form create
    */
    public function create()
    { 
        return view("blog.create");
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

        $title = $request->title;

        DB::table("blogs")->insert([
            "title" => $title,
            "slug" => Str::slug($title),
            "description" => $request->description
        ]);

        Session::flash("success", "Berita berhasil disimpan!");
        return redirect()->route("blog.index");
    }

    /**
     * Menampilkan data berdasarkan id
    */
    public function show($id) 
    {
        $blog = DB::table("blogs")->where("id", $id)->first();
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
        $blog = DB::table("blogs")->where("id", $id)->first();
        if (!$blog) {
            abort(404);
        }
        return view("blog.edit", compact("blog"));
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

        $title = $request->title;
        DB::table("blogs")->where("id", $id)->update([
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
        $blog = DB::table("blogs")->where("id", $id)->delete();

        Session::flash("success", "Berita berhasil dihapus!");
        return redirect()->route("blog.index", compact("blog"));
    }
}