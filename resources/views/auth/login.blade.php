<!DOCTYPE html>
<html lang="ru">
<head>
   <meta charset="UTF-8">
   <title>Вход на сайт</title>
 
   
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <script src="/js/bootstrap.min.js"></script>
     <script src="/js/jquery-2.2.2.js"></script>
  
   
   <script src="https://use.fontawesome.com/86ee2837b5.js"></script>

  


    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>
<body>


<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
         
        </div>
           
          

            <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="/">Главная</a></li>
           
          </ul>

       
          <p class="navbar-text navbar-right">
           <a href="/auth/register" class="btn btn-default">Регистрация</a></li>
         </p>
        

         
         

        </div><!--/.nav-collapse -->
      </div>
    </nav>
<br><br><br><br><br><br><br><br>
   <div class="container">
<div class="row">
 <div class="col-md-6 col-md-offset-3">
    
     @if(Session::has('message'))

<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>{!! Session::get('message') !!}</strong> 
</div>
 <hr><br>
@endif
    
  <form method="POST" action="/auth/login">
  {!! csrf_field() !!}

  <div class="form-group">

    <label for="email">E-mail</label>
    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
  </div>

  <div class="form-group">

   <label for="password">Пароль</label>
   <input type="password" name="password" id="password" class="form-control" required>

  </div>

  <div class="form-group">

   <input type="checkbox" name="remember">Запомнить меня

  </div>

   
   <div class="form-group">
              <label for=""></label>
              <img src="{{ captcha_src() }}" alt="captcha" class="captcha-img" data-refresh-config="default"><a href="#" id="refresh"> <i class="fa fa-refresh" aria-hidden="true"></i></a></p>
          </div>
          <div class="form-group">
              <label>Введите текст с изображения</label>
              <input class="form-control" type="text" name="captcha"/>
          </div>


  <div class="form-group">
      
   <button type="submit" class="btn btn-primary">Войти</button>

  </div>
  </form>
   
   <a href="/password/email"><i class="fa fa-key" aria-hidden="true"></i> забыт пароль</a>
   
 @if (count($errors) > 0) 
 <div class="alert alert-danger">
  <ul>
   @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
   @endforeach
   </ul>
   </div>
  @endif 
</div>
</div>



   </div>
   <script>
    $('#refresh').on('click',function(){
        var captcha = $('img.captcha-img');
        var config = captcha.data('refresh-config');
        $.ajax({
            method: 'GET',
            url: '/get_captcha/' + config,
        }).done(function (response) {
            captcha.prop('src', response);
        });
    });
</script>
   </body>
   </html>
