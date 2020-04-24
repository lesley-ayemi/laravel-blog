<?php

namespace App\Http\Controllers;

use App\Photo;

use App\Http\Requests;
use Illuminate\Http\Request;

class AdminMediasController extends Controller
{
    //
    public function index(){

        $photos = Photo::all();

        return view('admin.media.index', compact('photos'));

    }

    public function create(){

        return view('admin.media.create');

    }

    public function store(Request $request){
//by default dropzone uses a post supergobal called files
        $file = $request->file('file');

        $name = time() . $file->getClientOriginalName();

        $file->move('images', $name);

        Photo::create(['file'=>$name]);
    }
}
