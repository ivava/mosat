<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<nav class="navbar navbar-default" role="navigation">
		<div class="container-fluid main-navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-menu">
					<span class="sr-only">MOSAT</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="#" class="navbar-brand">MOSAT</a>
			</div>
			<div class="collapse navbar-collapse" id="main-menu">
				<ul class="nav navbar-nav">
					<li><a href="#">Новинки</a></li>
					<li><a href="#">Топ 100</a></li>
					<li><a href="#">Лента</a></li>
					<li><a href="#">Плейлист</a></li>
					<li><a href="download.html">Загрузить</a></li>
					<li><a href="#">Search</a></li>
				</ul>	
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#">11</a><li>
					<li><a href="#">22</a></li>
					<li class="dropdown btn-user">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">googlife5 <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="#">Ссылка</a></li>
							<li><a href="#">Ссылка</a></li>
							<li><a href="#">Ссылка</a></li>
							<li class="divider"></li>
							<li><a href="#">Еще ссылка</a></li>
						</ul>
					</li>
				</ul>			
			</div>
		</div>		
	</nav>

	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<img src="assets/img/avatar.jpg" alt="" class="user-avatar">
			</div>
			<div class="col-md-9">
				<div class="row">
					<div class="col-md-12">
						<h3 class="username">Martin Garrix</h3>
						<p class="userlogin">@MartinGarrix</p>
						<p><a class="btn btn-primary btn-lg user-subscribe" role="button">Подписаться</a></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4"><span class="user-stats"><span class="number">2</span><br>Мосата</span></div>
					<div class="col-md-4"><span class="user-stats"><span class="number">3,1К</span><br>Подписчиков</span></div>
					<div class="col-md-4"><span class="user-stats"><span class="number">17</span><br>Подписок</span></div>
				</div>
			</div>
		</div>
		<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#panel1">Панель 1</a></li>
  <li><a data-toggle="tab" href="#panel2">Панель 2</a></li>
  <li class="dropdown">
    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
      Другие панели 
      <b class="caret"></b>
    </a>
    <ul class="dropdown-menu">
      <li><a data-toggle="tab" href="#panel3">Панель 3</a></li>
      <li><a data-toggle="tab" href="#panel4">Панель 4</a></li>
    </ul>
  </li>
</ul>
 
<div class="tab-content">
  <div id="panel1" class="tab-pane fade in active">
    <h3>Панель 1</h3>
    <p>Содержимое 1 панели...</p>
  </div>
  <div id="panel2" class="tab-pane fade">
    <h3>Панель 2</h3>
    <p>Содержимое 2 панели...</p>
  </div>
  <div id="panel3" class="tab-pane fade">
    <h3>Панель 3</h3>
    <p>Содержимое 3 панели...</p>
  </div>
  <div id="panel4" class="tab-pane fade">
    <h3>Панель 4</h3>
    <p>Содержимое 4 панели...</p>
  </div>
</div>
	</div>

	
</body>
</html>