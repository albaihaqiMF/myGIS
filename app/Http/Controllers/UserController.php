<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('roles:1');
    }
    public function index()
    {
        $data = User::paginate(8);
        return view('admin.user.index', compact('data'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $attr = $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'username' => 'required|max:64|unique:users,username',
            'role_id' => 'between:1,2',
        ]);
        $defaultPassword = "password";
        $attr['password'] = bcrypt($defaultPassword);

        User::create($attr);

        return back();
    }
}
