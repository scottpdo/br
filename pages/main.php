<?php
/*
Template Name: Main
*/
get_header(); ?>

<div class="content" data-name="parts">
	<h2>We sell<br />
		<a href="<?php echo home_url(); ?>/services/#parts" class="big"><span>used auto parts</span></a></h2>
</div>

<div class="content" data-name="scrap">
	<h2>We buy<br />
		<a href="<?php echo home_url(); ?>/services/#scrap" class="big"><span>scrap metal</span></a></h2>
</div>

<div class="content" data-name="junk">
	<h2>We buy<br />
		<a href="<?php echo home_url(); ?>/services/#junk" class="big"><span>junk vehicles<span></a></h2>
</div>

<div class="rotators">
	<div class="bar"></div>

	<div class="active module" data-name="parts"></div>

		<div class="sep"></div>

	<div class="module" data-name="scrap"></div>

		<div class="sep"></div>

	<div class="module" data-name="junk"></div>
</div>

<?php get_footer(); ?>
