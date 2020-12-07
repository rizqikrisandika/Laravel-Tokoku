<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use UxWeb\SweetAlert\SweetAlert;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pengguna = User::all();

        return view('admin.pengguna',compact('pengguna'));
    }

    public function profile()
    {
        $user = User::where('id',Auth::user()->id)->first();

        return view('profile.index',compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = User::where('id',Auth::user()->id)->first();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->city = $request->city;
        $user->address = $request->address;
        $user->zipcode = $request->zipcode;

        $user->update();

        alert()->success('Ubah Profil', 'Sukses');

        return redirect()->route('profile.index');
    }
}
