<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class MyAuth extends Controller
{
     public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
        
    }
    
public function auth(Request $request) {
    
    $this->validate($request, [
'email' => 'required|max:250|email',
'password' => 'required|min:6',
'captcha' => 'required|captcha',
]);
    
if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password'),'status'=>'1'])) //классная функция в Laravel, котороая проверяет учетные данные в таблице users
{
return redirect('/lk'); // если все ОК, то перекидываем на страцу site.ru/profile, это так, для примера
}
else if( DB::table('confirm_users')->where('email', $request->email)->count() != 0 ) {
    
return view('auth.alreadyreg');
}

else 
{
    
return back()->with('message','Не правильный логин или пароль'); // если все плохо, то возвращаем пользователя к вводу логина и пароля с сообщением
}

}
}