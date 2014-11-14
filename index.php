<?php
require_once 'php/utils.php';
require_once 'php/Toshl.php';
$toshl = new Toshl('toshl_export.csv');
$tags = array(
	'mancare', 
	'dulciuri',
	'masina', 
	'motorina', 
	'facturi', 
	'donatie', 
	'cadouri', 
	'electronice'
	);
$year = 2014;
foreach ($tags as $tag) {
	$data[] = $toshl->aggregateTagYear($tag, $year);	
}
//dump($data);
$jsData = 'var toshData = '.CJSON::encode($data);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Toshl</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

	<link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" />
	<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
	<script src="js/less-1.3.3.min.js"></script>
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->
	
	<!--link href="css/bootstrap.min.css" rel="stylesheet"-->
	<link href="css/style.css" rel="stylesheet">

  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
  <![endif]-->

  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-57-precomposed.png">
  <link rel="shortcut icon" href="img/favicon.png">
	<script>
		<?php echo $jsData;	?> 
	</script>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/highcharts/highcharts.js"></script>
	<script type="text/javascript" src="js/highcharts/exporting.js"></script>
	<script type="text/javascript" src="js/underscore-min.js"></script>
	<script type="text/javascript" src="js/backbone-min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
</head>

<body>
	
<a id="top"></a>
<div class="container">
	<div class="row clearfix"><br />
		<div class="col-md-12 column">
			<nav class="navbar navbar-default" role="navigation">
				<div class="navbar-header">
					 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> 
					 <span class="sr-only">Toggle navigation</span>
					 <span class="icon-bar"></span>
					 <span class="icon-bar"></span>
					 <span class="icon-bar"></span>
					 </button> <a class="navbar-brand" href="#">Toshl Graphics</a>
				</div>
				
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li>
							<a href="?path=">all</a>
						</li>
						<li>
							<a href="?path=frontend">frontend</a>
						</li>
						<li>
							<a href="?path=backend">backend</a>
						</li>
						<li>
							<a href="?path=common">common</a>
						</li>
					</ul>
					<form class="navbar-form navbar-left" role="search">
						 <div class="input-group">
      						<!--div class="input-group-addon"><?php echo LOCAL_ROOT ?>/</div-->
							<input class="form-control" type="text" style="width: 600px;" name="path" value="<?php //echo $path ?>"/>
							<button type="submit" class="btn btn-primary">Diff</button>
    					</div>
 					</form>
				</div>
			</nav>
		</div>
	</div>
	<div class="row clearfix">
		<div class="col-md-2 column">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						Tags
					</h3>
				</div>
				<div class="panel-body">
					<!--button type="button" class="btn btn-block btn-primary">Download changes</button>
					<br /-->
					<?php //echo $toshl->renderTags(); ?>
				</div>
			</div>
		</div>
		<div class="col-md-10 column">
			<div id="highcharts" style="min-width: 310px; height: 400px; margin: 0 auto"></div>	
		</div>
	</div>
</div>
</body>
</html>