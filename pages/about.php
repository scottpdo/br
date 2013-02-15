<?php 
/*
Template Name: About
*/
get_header(); ?>

<h1 class="visuallyhidden"><?php the_title(); ?></h1>

<h2 class="tagline">Family Owned &amp; Operated<br />Since 1964.</h2>
<p class="big no-touch">Hover over the <span class="hotspot"></span> to learn about our facilities.</p>
<p class="big touch">Touch the <span class="hotspot"></span> to learn about our facilities.</p>

<div class="content">
	<div class="bg scale info-block">
		<p>Our on-site 70 foot scale weighs in vehicles and loads of scrap. We also have a pallet scale available to weigh non-ferrous materials.</p>
	</div>
	<div class="hotspot-container scale">
		<div class="hotspot">
		</div>
	</div>

	<div class="bg crane info-block">
		<p>Our fleet includes excavators to help you unload swiftly and semis for our daily hauls.</p>
	</div>
	<div class="hotspot-container crane">
		<div class="hotspot">
		</div>
	</div>

	<div class="bg scrap info-block">
		<p>We have 45 acres of inventory, made up of auto parts, junk vehicles, and scrap metal. We sell locally and ship nationwide.</p>
	</div>
	<div class="hotspot-container scrap">
		<div class="hotspot">
		</div>
	</div>
</div>

<?php get_footer(); ?>