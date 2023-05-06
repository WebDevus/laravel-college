<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ActionsController extends Controller
{
    public function register()
    {
        return view('actions.register');
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
            'password_repeat' => 'required'
            ],
            [
            'name.required' => 'Вы не указали ФИО!',
            'surname.required' => 'Вы не указали ФИО!',
            'login.required' => 'Вы не указали логин!',
            'email.required' => 'Вы не указали Email!',
            'email.email' => 'Формат почты указан неверно',
            'password.required' => 'Вы не указали пароль!',
            'password_repeat.required' => 'Вы не указали повтор пароля!'
            ]
        );

        $errors = $valid->errors();

        if ($valid->fails()) {
            return back()->with('error', $errors->first());
        }

        $user = User::where('login', $login)->orWhere('email', $email)->first();

        if($user) return back()->with('error', 'Пользователь с таким логином или почтой уже существует!');
        if($password_repeat !== $password) return back()->with('error', 'Введённый повтор пароля не совпадает с паролем!');

        $user = User::create([
            'name' => $name,
            'surname' => $surname,
            'patronymic' => $patronymic,
            'login' => $login,
            'email' => $email,
            'password' => $password
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
