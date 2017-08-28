<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<script type="text/javascript" src="/js/jquery-1.8.2.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
    
      <a class="navbar-brand" href="#">Blog</a>
    </div>

  </div><!-- /.container-fluid -->
</nav>

<div class="container-fluid">

	@yield('content')
 
</div>

<div class="panel-footer">
 <p class="text-muted">footer</p>
</div>
<style type="text/css">
.panel-footer {
/*   position: absolute; */
/*   bottom: 0; */
  width: 100%;
  /* Set the fixed height of the footer here */
  height: 60px;
  background-color: #333;
}

</style>
</body>
</html>