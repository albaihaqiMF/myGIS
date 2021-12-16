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
        $data = User::where('area_id',auth()->user()->area_id)->paginate(8);
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

        $user = User::whereDate('created_at', today())->get()->count();
        $id = date('ymd') . "1" . $this->intTo3Digits($user+1);
        $defaultPassword = "password";
        $attr['id'] = $id;
        $attr['password'] = bcrypt($defaultPassword);

        $attr['area_id'] = auth()->user()->area_id;

        $attr['name'] = ucwords(strtolower($request->name));

        User::create($attr);

        return back()->with('success', 'User Created Succesfully');
    }
}
