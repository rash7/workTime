<!DOCTYPE html>
<html lang="ru">
<head>
   <meta charset="UTF-8">
   <title>Приложение учета времени</title>
   <link href="/css/bootstrap.min.css" rel="stylesheet">
   <script src="/js/jquery-2.2.2.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    
   
    
 
 
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



<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="true">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">Главная</a>
    </div>

 

    <div class="navbar-collapse collapse in" id="bs-example-navbar-collapse-1" aria-expanded="true">
      <ul class="nav navbar-nav">
       
       <li><a href="/add">Добавить сотрудника</a></li>
        
        <li><a href="/otchet">Отчеты</a></li>
        <li><a href="/workers">Сотрудники</a></li>
       
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
       
       
       
        <li class="dropdown" >
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ $user->name }}<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Личные данные</a></li>
            <li><a href="#">Настройки</a></li>
            <li class="divider"></li>
              <li><a href="/auth/logout">Выход</a></li>
           
          </ul>
          
        </li>
        
      </ul>
    </div>
  </div>
</nav>




    

   

   <div class="container">
     
  
 <br>
 <br>
 <br>
 <br>
 <div class="row">
 <div class="col-md-4">
<ul class="breadcrumb">
  <li class="active">Управление временем</li>
</ul>
</div>
</div>
<br>


<div class="row">
 <div class="col-sm-4 col-sm-push-3 well">
   <h3>Сотрудник {{ $worker->name }} {{ $worker->surname }}</h3>
   <hr>
   <form name="loginForm" method="POST" action="/timestart" >
   
   {{ csrf_field() }}

    <input type="submit" name="save" value="Начал работать"  class="btn btn-success"  @if($start == 0) {{ 'disabled="disabled"'}}
    @endif>
    <input type="hidden" name="id" value="{{ $worker->id }}">
    </form>
    <br>
    <form name="loginForm" method="POST" action="/timestop" 
    >
   
   {{ csrf_field() }}

    <input type="submit" name="save" value="Закончил работать"  class="btn btn-warning"  @if($stop == 0) {{'disabled="disabled"'}}
    @endif
    >
    <input type="hidden" name="id" value="{{ $worker->id }}">
    </form>
  
 </div>
</div>
   
    @if(isset($hours) && isset($min) && isset($sutki))
   
   <div class="row">
 <div class="col-sm-4 col-sm-push-3 well">
  
  
    <div class="form-group">
      <h2>Сотрудник работает уже <strong> @if($sutki>0) {{ $hours+24*$sutki }} @else {{ $hours }} @endif  ч. и {{ $min }} мин. </strong> с момента нажатия кнопки старт</h2
    </div>
   
    


</div>
   
   
   
 </div>



    
      
    @endif 



</body>
</html>