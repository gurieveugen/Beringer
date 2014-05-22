<?php
/*
 * @package WordPress
 * Template Name: Team Detail Page
*/
?>
<?php get_header(); ?>
<div class="breadcrumbs-area hidden-xs">
	<div class="center-wrap cf">
		<ul class="breadcrumbs">
			<li><a href="#">Home</a></li>
			<li><a href="#">About</a></li>
			<li>Page Name</li>
		</ul>
	</div>
</div>
<header class="page-title visible-xs">
	<h1>Aðalsteinn Jóhannsson</h1>
</header>
<div class="main-team-detail center-wrap cf">
	<div class="td-column">
		<div class="image">
			<img src="<?php echo TDU; ?>/images/photo-1-big.jpg" alt="">
		</div>
		<div class="contact-block-xs visible-xs">
			<strong><a href="mailto:emailname@beringerfinance.com">emailname@beringerfinance.com</a></strong>
			<h4>CEO of BERINGER FINANCE</h4>
		</div>
		<div class="contact-block hidden-xs">
			<h4>Beringer Finance</h4>
			<address>Birger Jarlsgatan 4 | 114 34 Stockholm</address>
			<strong><a href="mailto:emailname@beringerfinance.com">emailname@beringerfinance.com</a></strong>
		</div>
		<div class="contact-block hidden-xs">
			<h4>Phone:</h4>
			<dl class="cf contact-list">
				<dt>Tel (Stockholm):</dt>
				<dd>+46 8 551 182 20</dd>
				<dt>Tel (Reykjavik):</dt> 
				<dd>+46 31 760 80 75</dd>
			</dl>
		</div>
	</div>
	<div class="td-content">
		<div class="hgroup hidden-xs">
			<h1>Aðalsteinn Jóhannsson</h1>
			<h5>President / CEO of Beringer Finance</h5>
		</div>
		<div class="td-text">
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore ma aliqua. Ut enm ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequa Duis aute irure dolor in repehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint aecat cupidatat non proident, sunt in culpqui officia deserunt mollit anim id est laborum.</p>
			<p>Incididunt mollit dolore pariatur. officia dolore aute nulla anim magna consectetur nulla commodo ipsum nulla labor is est eu culpa sint undefined ut.</p>
		</div>
		<div class="td-section">
			<div class="decor-line"></div>
			<div class="titles">
				<h3>EDUCATION</h3>
				<h4>Sub heading for education section that will lead the user.</h4>
			</div>
			<ul>
				<li>Graduated this University - 1992</li>
				<li>Bachelors in Finance</li>
				<li>Another bullet item to add</li>
			</ul>
		</div>
	</div>
</div>
<?php get_footer(); ?>