<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\ConfirmUsers;
use Validator;



class AdvancedReg extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    
   public function __construct()
    {
        $this->middleware('guest');
    }
  
   
   
   public function register(Request $request)
{
//$this->validate($request, [
//'name' => 'required|unique:users|max:150',

//'email' => 'required|unique:users|max:250|unique:confirm_users|email',
//'password' => 'required|confirmed|min:6',
//]);

$this->validate($request, [
'name' => 'required|max:150',
'email' => 'required|max:250|email',
'password' => 'required|confirmed|min:6',
'captcha' => 'required|captcha',
]);


$user1=User::where('email', $request->input('email'))->first(); //делаем выборку из базы по введенному email
//dd($user1);
if(!empty($user1->email))
{
if($user1->status==0)      // если email существует и его статус 0, то предлагаем повторно отправить письмо
{
//return 'Такой email уже зарегестрирован, но не подтвержден. Проверьте почту или <a href="stie.ru/repeat_confirm">запросите</a> повторное подтверждение email';

    return view('auth.alreadyreg');
}
else  //если статус не равен 0, то равен 1, следовательно email уже подтвержден
{
    return back()->with('message','Пользователь с таким email уже зарегестрирован. Забыли пароль?');
//return "Пользователь с таким email уже зарегестрирован. Забыли пароль?";
}
}


     $user=User::create([
'name' => $request->input('name'),
'email' => $request->input('email'),
'password' => bcrypt($request->input('password')),
]);
 
// dd($user);

if($user)
{
$email=$user->email;  //это email, который ввел пользователь
$token=str_random(32); //это наша случайная строка
$model=new ConfirmUsers; //создаем экземпляр нашей модели
$model->email=$email; //вставляем в таблицу email
$model->token=$token; //вставляем в таблицу токен
$model->save();      // сохраняем все данные в таблицу
//отправляем ссылку с токеном пользователю
Mail::send('emails.confirm',['token'=>$token],function($u) use ($user)
{
$u->from('worktime@rashid96.myjino.ru');
$u->to($user->email);
$u->subject('Подтверждение регистрации appWorkTime');
});

return back()->with('message',' Регистрация успешна. Осталось подтвердить почту. Мы отправили вам письмо с подтверждением к вам на почту. Время подтверждения 1 час. ');
}

else {
return back()->with('message','Сбои в работе сайта. Мы уже занимаемся этим вопросом');
}


}

public function confirm($token)
{
$model=ConfirmUsers::where('token','=',$token)->firstOrFail(); //выбираем запись с переданным токеном, если такого нет то будет ошибка 404
$user=User::where('email','=',$model->email)->first(); //выбираем пользователя почта которого соответствует переданному токену
$user->status=1; // меняем статус на 1
$user->save();  // сохраняем изменения
$model->delete(); //Удаляем запись из confirm_users



 

 
return view('auth.confirmed'); 
}

public function getRepeat()

{

return view('auth.repeat');
//возвращаем вид с формой для ввода email
}

public function postRepeat(Request $request)
{
    $this->validate($request, [
'email' => 'required|max:250|email',
'captcha' => 'required|captcha',
]);

$user=User::where('email','=',$request->input('email'))->first(); //делаем выборку из таблицы users по указанному email

if(!empty($user->email)) // проверяем, что email существует
{
if($user->status==0 )
{
$user->touch(); // это метод, который обновляет поле updated_at на текущее время.
$confirm=ConfirmUsers::where('email','=',$request->input('email'))->first(); //делаем выборку из таблицы confrim_users
$confirm->touch(); // тоже обновляем поле updated_at




    Mail::send('emails.confirm',['token'=>$confirm->token],function($u) use ($user)
{
$u->from('worktime@rashid96.myjino.ru');
$u->to($user->email);
$u->subject('Подтверждение регистрации appWorkTime');
});

return back()->with('message','Письмо для активации успешно выслано на указанный адрес'); //возвращаем пользователя обратно с сообщением, что письмо отправленно
}
    
    

else {

return back()->with('message','Такой email уже подтвержден'); 
}

}
else { 
return back()->with('message','Нет пользователя с таким email'); 
}

}

}
