
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Изменение пароля</title>
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
           <a href="/auth/login" class="btn btn-default">Войти</a></li>
         </p>
     

         
         

        </div><!--/.nav-collapse -->
      </div>
    </nav>

   <br><br><br><br><br><br>
<div class="container">
   



<div class="row">
 <div class="col-md-6 col-md-offset-3">
 <!-- resources/views/auth/reset.blade.php -->
<h1>Изменение пароля</h1>
<hr>
@if (count($errors) > 0) 
 <div class="alert alert-danger">
  <ul>
   @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
   @endforeach
   </ul>
   </div>
   <hr>
  @endif 
<form method="POST" action="/password/reset">
    {!! csrf_field() !!}
    <div class="form-group">
    <input type="hidden" name="token" value="{{ $token }}">

    <div>
        <label for="email">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" class="form-control">
    </div>
    </div>
    
    <div class="form-group">
    
    <div>
        <label for="password">Пароль</label>
        <input type="password" name="password" class="form-control">
    </div>

   </div>
    
    
    <div class="form-group">
    
    <div>
        <label for="password_confirm">Повторите пароль</label>
        <input type="password" name="password_confirmation" class="form-control">
    </div>
    
    </div>
    
    
    <div class="form-group">
              <label for=""></label>
              <img src="{{ captcha_src() }}" alt="captcha" class="captcha-img" data-refresh-config="default"><a href="#" id="refresh"> <i class="fa fa-refresh" aria-hidden="true"></i></a></p>
          </div>
          <div class="form-group">
              <label>Введите текст с изображения</label>
              <input class="form-control" type="text" name="captcha"/ required>
          </div>

    
    <div class="form-group">
    
    <div>
        <button type="submit" class="btn btn-primary">
           Измеить пароль
        </button>
        </div>
    </div>
</form>
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


  