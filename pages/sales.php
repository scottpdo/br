<?php 
/*
Template Name: Featured Sales
*/
$sort = $_GET['sort'];

function fittext() {
	$template_url = get_bloginfo('template_url');
	echo '<script src="'.$template_url.'/js/jquery.fittext.js"></script>'; ?>
	<script>
		jQuery(window).load(function(){
			jQuery('.sorter').fitText(0.3);
			jQuery('section.alignright').fitText(0.85);
		});
		jQuery('.sorter').fitText(0.3);
		jQuery('section.alignright').fitText(0.85);
	</script>
<?php }
add_action('wp_footer', 'fittext');
get_header(); ?>

<h1 class="visuallyhidden"><?php the_title(); ?></h1>

<div class="content clearfix">

	<?php 
	$sales = array_reverse(get_field('sales'));
	if ($sort == 'year') {
		$years = array();
		foreach ($sales as $index => $sale) {
			$years[$index] = $sale['year'];
		}	
		rsort($years); // this is an array of the given years, descending

		foreach ($years as $index => $year) {
			// Only bother with it if the year is set
			if ($year) {
				foreach ($sales as $key => $sale) {
					if ($sale['year'] == $year) {
						for ($i = $key - 1; $i >= $index; $i--) {
							$sales[$i+1] = $sales[$i];
						}
						$sales[$index] = $sale;
					}
				}
			}
		}

	} elseif ($sort == 'price') {
		$prices = array();
		foreach ($sales as $index => $sale) {
			$prices[$index] = $sale['price'];
		}	
		rsort($prices); // this is an array of the given prices, descending

		foreach ($prices as $index => $price) {
			// Only bother with it if the price is set
			if ($price) {
				foreach ($sales as $key => $sale) {
					if ($sale['price'] == $price) {
						for ($i = $key - 1; $i >= $index; $i--) {
							$sales[$i+1] = $sales[$i];
						}
						$sales[$index] = $sale;
					}
				}
			}
		}
	} elseif ($sort == 'a_z') {
		sort($sales);
	}

	if ($sales) { ?>

		<section class="alignleft">
			<div class="sorter">
				Sort by
			</div>
			<?php if (!isset($_GET['sort']) || $_GET['sort'] == 'latest' ) { $sort = 'latest'; }
					  elseif ($_GET['sort'] == 'year') { $sort = 'year'; }
					  else { $sort = 'a_z'; } ?>
			<ul class="<?php echo $sort; ?>">
				<li class="newest"><a href="<?php the_permalink(); ?>">Latest</a></li>
				<li class="type"><a href="<?php the_permalink(); ?>?sort=year">Year</a></li>
				<li class="type"><a href="<?php the_permalink(); ?>?sort=price">Price</a></li>
				<li class="a_z"><a href="<?php the_permalink(); ?>?sort=a_z">A-Z</a></li>

				<div class="dropdown">
					<div class="arrow"></div>
				</div>
			</ul>
			<select onchange="location=this.options[this.selectedIndex].value;">
				<option value="<?php the_permalink(); ?>">Latest</option>
				<option value="<?php the_permalink(); ?>/?sort=year">Year</option>
				<option value="<?php the_permalink(); ?>/?sort=price">Price</a></option>
				<option value="<?php the_permalink(); ?>?sort=a_z">A-Z</option>
			</select>
		</section>
		
		<section class="alignright top">
			<a href="http://www.bandrautotruckparts.com/inventory/retail.htm" target="_blank">Full inventory search</a>
		</section>

		<article class="clearfix">
		<?php
		foreach ($sales as $sale) { 
			$year = $sale['year'] > 0 ? $sale['year'] : '';
			$name = $sale['name'];
			$price = $sale['price'];
			?>

			<div class="module">
				<?php if ($sale['photos']) { 
					/* echo '<pre>';
					var_dump($sale['photos']);
					echo '</pre>'; */ ?>
					<img src="<?php echo $sale['photos'][0]['photo']; ?>" alt="<?php echo $sale['name']; ?>" />
					<h3 class="lowercase"><?php echo $year.' '.$name; ?></h3>
					<?php if ($price) { ?>
					<p class="big">$<?php echo th($price); ?></p>
					<?php } ?>
				<?php } else { ?>
					<h3 class="lowercase"><?php echo $year.' '.$name; ?></h3>
					<p><?php echo $sale['short_description']; ?></p>
					<?php if ($price) { ?>
					<p class="big">$<?php echo th($price); ?></p>
					<?php } ?>
				<?php } ?>
				<p class="big more">More</p>
				
				<aside class="extended">
					<h3><?php echo $year.' '.$name; ?> <span class="small"><?php if ($price) { echo '$'.th($price); } ?></span></h3>
					<p class="short"><?php echo $sale['short_description']; ?></p>
					<p class="long"><?php echo $sale['long_description']; ?></p>
					<p style="margin-bottom: 20px;">For more information on purchasing, please <a href="<?php echo home_url(); ?>/contact" title="Contact Us">contact&nbsp;us</a>.</p>
					<?php if ($sale['photos']) { 
						foreach ($sale['photos'] as $photos) { ?>
						<img src="<?php echo $photos['photo']; ?>" alt="<?php echo $name; ?>" />
					<?php } // end foreach
					} // endif?>
				</aside>
			</div>
		<?php
		} // end foreach ?>
		</article>
	<?php } // end if

	?>

	<section class="bottom clearfix">
		<a href="http://www.bandrautotruckparts.com/inventory/retail.htm" target="_blank">Full inventory search</a>
	</section>

</div>

<div class="description">
	<div class="scroll"></div>
	<div class="close"></div>
</div>

<?php get_footer(); ?>