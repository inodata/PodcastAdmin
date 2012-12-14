<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
  	<div id="header">
  		<div>
  			<div id="logo">
  				<img src="/assets/default_image.jpg" width="120" height="60"></img>
  			</div>
  			<div id="navigation">
  				<ul>
  					<li><a href="#">Home</a></li>
  					<li><a href="#">Web Site</a></li>
  					<li><a href="#">Shop</a></li>
  					<li><a href="#">Blog</a></li>
  					<li class="last"><a href="#">Logout</a></li>
  				</ul>
  			</div>
  		</div>
  		<div>
  			<div id="navigation-module">
  				<ul>
  					<li class="<?php echo $sf_context->getModuleName() == "channel" ? "active":""?>">
  						<a href="<?php echo url_for("channel")?>">Channel</a>
  					</li>
  					<li class="<?php echo $sf_context->getModuleName() == "item" ? "active":""?>">
  						<a href="<?php echo url_for("item")?>">Podcast</a>
  					</li>
  					<li class="<?php echo $sf_context->getModuleName() == "mixtape" ? "active":""?>">
  						<a href="<?php echo url_for("mixtape")?>">Sync Podcast</a>
  					</li>
  				</ul>
  			</div>
  			<div id="search">
  				<form action="#" method="post">
  					<input type="text" name="text"></input>
  					<input type="submit" name="search" value="Search"></input>
  				</form>
  			</div>
  		</div>
  		<dir>
  			<!-- Breadcrumbs -->
  		</dir>
  	</div>
    <?php echo $sf_content ?>
  </body>
</html>
