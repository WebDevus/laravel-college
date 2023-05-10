<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ActionsController extends Controller
{
    public function register()
    {
        return view('actions.register');
    }

    public function auth()
    {
        return view('actions.auth');
    }

    public function authPost(Request $r)
    {
        $login = $r->login;
        $password = $r->password;

        if(!$login) return back()->with('error', 'Вы не указали логин!');
        if(!$password) return back()->with('error', 'Вы не указали пароль!');

        $user = User::where('login', $login)->first();

        if(Hash::check(Hash::make($password), $user->password)) return back()->with('error', 'Введены неправильные данные!');

        auth()->login($user, true);

        return redirect()->route('index');
    }

    public function registerPost(Request $r)
    {
        $name = $r->name;
        $surname = $r->surname;
        $patronymic = $r->patronymic;
        $login = $r->login;
        $email = $r->email;
        $password = $r->password;
        $password_repeat = $r->password_repeat;

        $valid = Validator::make($r->all(),
            [
            'name' => 'required',
            'surname' => 'required',
            'login' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'password_repeat' => 'required',
            'rules' => 'required'
            ],
            [
            'name.required' => __('translate.validation.name'),
            'surname.required' => __('translate.validation.surname'),
            'login.required' => __('translate.validation.login'),
            'email.required' => __('translate.validation.email'),
            'email.email' => __('translate.validation.emailNotEmail'),
            'password.required' => __('translate.validation.password'),
            'password_repeat.required' => __('translate.validation.passwordRepeat'),
            'rules.required' => __('translate.validation.rules')
            ]
        );

        $errors = $valid->errors();

        if ($valid->fails()) {
            return back()->with('error', $errors->first());
        }

        $user = User::where('login', $login)->orWhere('email', $email)->first();

        if($user) return back()->with('error', 'Пользователь с таким логином или почтой уже существует!');
        if($password_repeat != $password) return back()->with('error', 'Введённый повтор пароля не совпадает с паролем!');

        $user = User::create([
            'name' => $name,
            'surname' => $surname,
            'patronymic' => $patronymic,
            'login' => $login,
            'email' => $email,
            'password' => Hash::make($password)
        ]);

        auth()->login($user, true);

        return redirect()->route('index');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('index');
    }
}
