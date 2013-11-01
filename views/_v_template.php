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
	<script src="/js/jquery.js"></script>
	<script src="/js/jqBootstrapValidation.js"></script>
	<script type="text/javascript" src="/js/bootstrap.min.js"></script>
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
	<script>
  $(function () { $("input,select,textarea").jqBootstrapValidation(); } )
</script>
	
</head>

<body>	
	<div class="container">
		<!--Header NAVBAR Stuff -->	
		<div class="navbar navbar-default">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
			  </button>
			  <a class="navbar-brand" href="/">OPA! Home</a>
			</div>
		
		<div class="navbar-collapse collapse">
		  <ul class="nav navbar-nav">
		    <li><a href="/index/about">About</a></li>
		  </ul>
		  
		  <div id="nav">
			<ul class="nav navbar-nav navbar-right"  >
			<!--New menu buttons will dynamically show up here. -->
			</ul>
		  </div>
		</div><!--/.nav-collapse -->
	
	      </div> <!--navbar-->
		
		
	
	
		<?php if(isset($content)) echo $content; ?>
	
		<?php if(isset($client_files_body)) echo $client_files_body; ?>
		
		<!--Footer stuff-->
		<hr class="left">
			<br>
		<div class="footclear footer">
			<p>&copy; OPA! 2013 Mark Stites ~ markstites [at] fas [dot] harvard [dot] edu</p>
		</div>
		
	</div>	 <!--container-->
</body>
</html>