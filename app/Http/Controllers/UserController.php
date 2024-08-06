<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\ResetPasswordRequest;
use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Lib\Repositories\Interfaces\IUserRepository;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public $user;

    public function __construct(IUserRepository $user)
    {
        $this->user = $user;
    }

    public function index(Request $request)
    {
        $users = $this->user->getAllUserWithPagination($request);
        return view('users.index', compact('users'));
    }

    public function login()
    {
        return view('users.login');
    }

    public function loginUser(Request $request)
    {
        $remember = $request->remember;

        !is_null($remember) ? $remember = true : $remember = false;

        $user = $this->user->checkUserByEmail($request->email);

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user, $remember);
            return redirect()->route('home')->with('success', 'Uğurlu');
        } else {
            return redirect()->back()->with('error', 'Email və ya Şifrə yanlışdır')->onlyInput('email', 'remember');
        }
    }

    public function logoutUser()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function store(StoreUserRequest $request)
    {
        $this->user->createUser($request);

        return response()->json([
            'status' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = $this->user->getUserById($id);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $this->user->updateUser($id, $request);

        return response()->json([
            'status' => 'success',
            'message' => 'Uğurlu'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->user->deleteUser($id);
    }

    public function reset_password(ResetPasswordRequest $request)
    {
        $user = User::where('email',Auth::user()->email)->first();

        $user->update([
            'password'=>$request->new_password
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Uğurlu'
        ]);
    }
}
