<?php

namespace App\Http\Controllers;

use App\Tag;
use App\User;
use App\Events\UserCreated;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserPost;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateUserPost;


class UserController extends Controller
{
  
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('rol.admin'); NO FUNCIONA
 
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd(Tag::find(3)->users);
        User::find(3)->tags()->sync([1,2,3,4]);
        $users = User::with('rol')->orderBy('created_at', 'desc')->paginate(2);
        return view('dashboard.user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.user.create', ['user' => new User() ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserPost $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'rol_id' => 1, // rol de admin
            'surname' => $request['surname'],
            'email' => $request['email'],
            'password' => $request['password'],
        ]);
    
        event(new UserCreated($user));

        return back()->with('status', 'Uusario creado con exito');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('dashboard.user.show', ["user" => $user]); 

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('edit',$user);
        return view('dashboard.user.edit', ["user" => $user]); 

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserPost $request, User $user)
    {
        $this->authorize('edit',$user);

        $user->update([
            'name' => $request['name'],
            'surname' => $request['surname'],
            'email' => $request['email'],
        ]);
    
        return back()->with('status', 'Uusario actualizado con exito');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('status', 'Uusario eliminado con exito');
 
    }
}
