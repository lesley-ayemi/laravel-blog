<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UsersEditRequest;
use Illuminate\Support\Facades\Session;


use App\User;
use App\Role;
use App\Photo;



use App\Http\Requests;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $users = User::all();
        
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $roles = Role::pluck('name', 'id')->all(); //make sure to follow this format name before id

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {

        if(trim($request->password) == ''){

            $input = $request->except('password');

        } else{
            $input = $request->all();
            $input['password']= bcrypt($request->password);

        }


        //

        if($file = $request->file('photo_id')){

            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);

            $photo = Photo::create(['file'=>$name]);


            $input['photo_id'] = $photo->id;
            

        }
        User::create($input);

        return redirect('/admin/users');
        // return $request->all();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return view('admin.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::pluck('name', 'id')->all();
        

        //
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {


        $user = User::findOrFail($id);
        //
//hashing the password and validating it
        if(trim($request->password) == ''){

            $input = $request->except('password');

        } else{
            $input = $request->all();
            $input['password']= bcrypt($request->password);

        }

       if($file = $request->file('photo_id')){

        $name = time() . $file->getClientOriginalName();

        $file->move('images', $name);

        $photo = Photo::create(['file'=>$name]);

        $input['photo_id'] = $photo->id;


       }

       $user->update($input);
       Session::flash('updated_user', 'The User Has Been Updated');


       return redirect('/admin/users');
        // return $request->all();




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        //this will delete  the user but not the user image

        $user = User::findOrFail($id); 

        unlink(public_path() . $user->photo->file); //unlink is a function in php we in the public path and the accessor we created

        $user->delete();

        Session::flash('deleted_user', 'The User Has Been Deleted');

        return redirect('/admin/users');


    }
}
