<?php

namespace App\Http\Controllers;

use App\Photo;

use App\Http\Requests;
use Illuminate\Http\Request;

class AdminMediasController extends Controller
{
    //
    public function index(){

        $photos = Photo::paginate(5);

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
    

    public function destroy($id){

        $photo = Photo::findOrFail($id);

        unlink(public_path(). $photo->file);

        $photo->delete();



    }

    public function deleteMedia(Request $request){
        //for single delete button and checking it
        // if(isset($request->delete_single)){

        //     $this->destroy($request->photo);
        //     return redirect()->back();
            
        // }
      
        if(isset($request->delete_all) && !empty($request->checkBoxArray)){

            $photos = Photo::findOrFail($request->checkBoxArray);
            foreach ($photos as $photo) {

                unlink(public_path(). $photo->file);
                $photo->delete();
            }
      
            return redirect()->back();

        } else{
            return redirect()->back();
            
        }

      

    }
}
