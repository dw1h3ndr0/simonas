<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\User;

class ChangePasswordController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($id)
    {

        if (session( 'success_message')){           
            Alert::success('Berhasil', session('success_message'));
        }
        if (session('eror')){
            Alert::error('Gagal', session('eror'));
        }

        $pengguna = \App\User::findOrFail($id);
        return view('petugas.changePassword',['pengguna' => $pengguna]);
    } 

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request, $id, $page)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword($id)],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        $user = User::find($id);
        $user->update(['password'=> Hash::make($request->new_password)]);
        // dd('Password change successfully.');
        
        Alert::success('Berhasil', 'Password berhasil diganti');
        return view('petugas.changePassword',['pengguna' => $user]);
        
    }
}
