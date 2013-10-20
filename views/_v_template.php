<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">				
	<!-- Controller Specific JS/CSS -->
	
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="/css/style.css">
	<script src="http://code.jquery.com/jquery.js"></script>
	<script type="text/javascript" src="/js/bootstrap.min.js"></script>
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>

<body>	

	<!--Header NAVBAR Stuff -->
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation" >
		<div class="container">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
	          <span class="icon-bar"></span>
	          <span class="icon-bar"></span>
	          <span class="icon-bar"></span> 
	        </button>
	        <a class="navbar-brand" href="/">OPA! Home</a>
	        <div class="navbar-collapse collapse" id="nav">
	          <ul class="nav navbar-nav">
		    <li><a href="/index/about">About</a></li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	</div>


	<?php if(isset($content)) echo $content; ?>

	<?php if(isset($client_files_body)) echo $client_files_body; ?>
	
	<!--Footer stuff-->
	<hr>
	<div class="footer">
		<p>&copy; OPA! 2013</p>
	</div>
	
</body>
</html>