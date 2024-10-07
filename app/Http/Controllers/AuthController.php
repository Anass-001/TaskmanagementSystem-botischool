<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Str;
use Hash;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgetPassWordMail;
use App\Http\Requests\ResetPassword;


class AuthController extends Controller
{
    public function reg()
    {
        return view('auth.reg');
    }

    public function reg_post(Request $request)
    {
        // dd($request->all());
        $user = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:8',
            'comfirm_password' => 'required_with:password|same:password|min:8',
            'is_role' => 'required'

        ]);

        $user = new User;
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->is_role = trim($request->is_role);
        $user->remember_token = Str::random(50);
        $user->save();

        return redirect('login')->with('success', 'Registered successfully');
    }

    public function login()
    {
        return view('auth.login');
    }
    public function login_post(Request $request)
    {
        // dd($request->all());

        // Tentative d'authentification de l'utilisateur avec les informations fournies
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], true)) {
            // Vérifier le rôle de l'utilisateur authentifié
            $role = Auth::user()->is_role;

            if ($role == '2') {
                return redirect('admin/dashboard');
            } elseif ($role == '1') {

                return redirect('manager/dashboard');
            } elseif ($role == '0') {

                return redirect('user/dashboard');
            } else {

                return redirect()->back()->with('error', 'Rôle non reconnu.');
            }
        } else {

            return redirect()->back()->with('error', 'Please enter the correct credentials.');
        }
    }



    public function forget()
    {
        return view('auth.forget');
    }
    public function forget_post(Request $request)
    {
        // dd($request->all());

        $user = User::where('email', $request->email)->first();

        if ($user) {
            // $user->remember_token = Str::random(50);
            $user->save();

            Mail::to($user->email)->send(new ForgetPassWordMail($user));

            return redirect()->back()->with('success', 'Le mot de passe a été réinitialisé');
        } else {
            return redirect()->back()->with('error', 'E-mail introuvable dans le système');
        }
    }
    public function getReset(Request $request, $token)
    {
        // dd($token);
        $user = User::where('remember_token', '=', $token);
        if ($user->count() == 0) {
            abort(403);
        }
        $user = $user->first();
        $data['token'] = $token;
        return view('auth.reset', $data);
    }

    public function postReset($token, ResetPassword $request)
    {

        $user = User::where('remember_token', '=', $token);
        if ($user->count() == 0) {
            abort(403);
        }
        $user = $user->first();
        $user->password = Hash::make($request->password);
        $user->remember_token = Str::random(50);
        $user->save();
        return redirect('login')->with('success', 'réinitialisation du mot de passe réussie');
    }


    public function logout()
    {
        Auth::logout();
        return redirect(url('/'));
    }
}
