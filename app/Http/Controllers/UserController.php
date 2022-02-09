<?php

namespace App\Http\Controllers;

use App\Mail\RegisterMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('roles:1');
    }
    public function index()
    {
        $data = User::whereNotIn('role_id', ['0'])->paginate(8);
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
        $id = date('ymd') . "1" . $this->intTo3Digits($user + 1);
        $defaultPassword = $this->generatePassword(rand(8, 10));
        $attr['id'] = $id;
        $attr['password'] = bcrypt($defaultPassword);

        $attr['name'] = ucwords(strtolower($request->name));

        User::create($attr);
        Mail::to($attr['email'])->send(new RegisterMail($attr['email'], $defaultPassword));
        return back()->with('success', 'User Created Succesfully');
    }
}
