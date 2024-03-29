<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display all users
     * 
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        if(Auth::User()->role == 'Admin')
        {
            $users = User::all();
        }else{
            $users = User::whereNot(function ($query) {
                $query->where('id', 2);
            })->get();
        }
        
        return view('users.index', compact('users'));
    }

    /**
     * Show form for creating user
     * 
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        return view('users.create');
    }

    /**
     * Store a newly created user
     * 
     * @param User $user
     * @param StoreUserRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {
        //For demo purposes only. When creating user or inviting a user
        // you should create a generated random password and email it to the user

        // $user->create(array_merge($request->validated(), [
        //     'password' => 'test' 
        // ]));

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:30',
            'specialNumber' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->specialNumber = $request->specialNumber;
        $user->password = $request->password;
        $user->save();
        
        return redirect()->route('users.index')->withSuccess(__('Użytkownik utworzony pomyślnie.'));
    }

    /**
     * Show user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) 
    {
        return view('users.show', [
            'user' => $user
        ]);
    }

    /**
     * Edit user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) 
    {

        if(Auth::User()->role == 'Admin')
        {
            $roles = Role::all();
        }else
        {
            $roles = Role::whereNot(function ($query) {
                $query->where('name', 'Admin');
            })->get();
        }

        return view('users.edit', [
            'user' => $user,
            'userRole' => $user->roles->pluck('name')->toArray(),
            'roles' => $roles
        ]);
    }

    /**
     * Update user data
     * 
     * @param User $user
     * @param UpdateUserRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) 
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:30',
            'specialNumber' => 'required|string|max:255',
        ]);

        $checkEmail = User::where('email', $request->email)->where('id', '!=', $id)->first();
        if($checkEmail){
            $user = User::find($id);
            if(Auth::User()->role == 'Admin')
            {
                $roles = Role::all();
            }else
            {
                $roles = Role::whereNot(function ($query) {
                    $query->where('name', 'Admin');
                })->get();
            }
            return view('users.edit')->with([
                'user' => $user,
                'userRole' => $user->roles->pluck('name')->toArray(),
                'roles' => $roles,
                'error' => 'Ten adres email jest już zajęty.'
            ]);
        }

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->specialNumber = $request->specialNumber;
        $user->update();

        $user->syncRoles($request->get('role'));

        return redirect()->route('users.index')
            ->withSuccess(__('Użytkownik został pomyślnie zaktualizowany.'));
    }

    /**
     * Delete user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) 
    {
        User::destroy($id);

        return redirect()->route('users.index')->withSuccess(__('Użytkownik został pomyślnie usunięty.'));
    }
}