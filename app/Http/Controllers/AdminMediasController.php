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
}
