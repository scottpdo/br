<?php 
/*
Template Name: Services
*/
get_header(); ?>

<h1 class="visuallyhidden"><?php the_title(); ?></h1>

<div class="cover full" data-name="parts"></div>
<div class="cover full" data-name="junk"></div>
<div class="cover full" data-name="scrap"></div>

<div class="content clearfix">
	<div class="cover" data-name="parts"></div>
	<h2 data-name="parts"><a href="#parts">Auto Parts</a></h2>
	<section class="module" data-name="parts" id="parts">
		<div>
			<?php the_field('parts'); ?>
		</div>
			
		<a class="inventory" href="http://www.bandrautotruckparts.com/inventory/retail.htm" target="_blank"><span>Car Part/Inventory search</span></a>
	</section>

	<div class="cover" data-name="junk"></div>
	<h2 data-name="junk"><a href="#junk">Junk Vehicles</a></h2>
	<section class="module" data-name="junk" id="junk">
		<div>
			<?php the_field('junk'); ?>
		</div>
	</section>

	<div class="cover" data-name="scrap"></div>
	<h2 data-name="scrap"><a href="#scrap">Scrap Metal</a></h2>
	<section class="module" data-name="scrap" id="scrap">
		<div>
			<?php the_field('scrap'); ?>
		</div>
	</section>

	<div class="bar">
	</div>
</div>

<?php get_footer(); ?>