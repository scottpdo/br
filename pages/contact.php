<?php 
/*
Template Name: Contact
*/
if (isset($_POST['submitted'])) {
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$org = $_POST['org'];
	$address = $_POST['address'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$zip = $_POST['zip'];
	$email = $_POST['email'];
	$services = $_POST['services'];
	$how = $_POST['how'];

	$emailTo = 'parts@bandrautotruckparts.com';
	$subject = 'B and R website contact from '.$firstName.' '.$lastName;
	$body = 'Name: '.$firstName.' '.$lastName."\n\n".
			'Organization: '.$company."\n\n".
			'Address: '.$address.' '.$city.', '.$state.' '.$zip."\n\n".
			'Email: '.$email."\n\n".
			'What services are you interested in: '.$services."\n\n".
			'How did you hear about us: '.$how;

	$headers = 'From: '.$firstName.' '.$lastName.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
	
	mail($emailTo, $subject, $body, $headers);
}

get_header(); ?>

<h1 class="visuallyhidden"><?php the_title(); ?></h1>

<div class="content">

	<h2 class="title">Contact Us</h2>

	<section class="hours">
		<h2>Hours of Operation</h2>
		<p><?php the_field('hours'); ?></p>
	</section>

	<section>
		<h2>Location &amp; Directions</h2>
		<?php the_field('location'); ?><br />
		<a href="<?php the_field('directions'); ?>" target="_blank">Get Directions</a>
	</section>

	<section class="contact-info">
		<h2>Contact Information</h2>
		<p>Phone: <?php the_field('phone'); ?><br />
		   Toll Free: <?php the_field('toll_free'); ?><br />
		   Fax: <?php the_field('fax'); ?><br />
		   <a href="mailto:<?php the_field('email'); ?>"><?php the_field('email'); ?></a>
		</p>
	</section>

	<a class="contact inventory"><span>Request info</span></a>

	<?php 
	// Unless the form has been submitted, show the form
	if (!isset($_GET['form']) || $_GET['form'] != 'sent') { ?>

		<form id="contact" action="<?php the_permalink(); ?>?form=sent" method="post">
			<h2>Get in touch with us</h2>

			<input id="firstName" name="firstName" type="text" placeholder="First Name*" />
			<input id="lastName" name="lastName" type="text" placeholder="Last Name*" />
			<input id="org" name="org" type="text" placeholder="Company/Organization" />
			<input id="address" name="address" type="text" placeholder="Street Address" />
			<input id="city" name="city" type="text" placeholder="City" />
			<input id="state" name="state" type="text" maxlength="2" placeholder="State" />
			<input id="zip" name="zip" type="text" maxlength="5" placeholder="Zip" />
			<input id="email" name="email" type="email" placeholder="Email*" />

			<p>What services are you interested in? (check all that apply)*</p>
			<ul>
				<li>Junk Vehicles</li>
				<li>Auto Parts</li>
				<li>Scrap Metal</li>
				<li>Other</li>
			</ul>
			<input id="services" name="services" type="hidden" />
			<input id="how" name="how" type="text" placeholder="How did you find out about us?" />

			<input id="submit" name="submit" type="submit" value="Submit" />
			<input type="hidden" name="submitted" id="submitted" value="true" />
			
			<div class="close"></div>
		</form>

	<?php } else { ?>
		<form id="contact" class="thanks">
			<h2>Thanks for getting in touch!</h2>
			<p>We'll get back to you soon.</p>
			<div class="close"></div>
		</form>
	<?php } ?>

</div>

<script type="text/javascript">
jQuery(document).ready(function($){
	var contactForm = $('form'),
		contactServices = $('form ul li'),
		servicesInput = $('#services'),
		newServices;

	var servicesArray = new Array('', '', '', '');
	contactServices.click(function(){
		$this = $(this);
		if (!servicesArray[$this.index()]) {
			servicesArray[$this.index()] = $this.text();
		} else {
			servicesArray[$this.index()] = '';
		}
		newServices = servicesArray[0]+', '+servicesArray[1]+', '+servicesArray[2]+', '+servicesArray[3];
		servicesInput.val(newServices);
	});

	var how = $('#how'),
		firstName, lastName, email;
	$.fn.extend({
		valid: function(){
			var submit = true;
			$this = $(this);

			if ($this.val().length === 0) {
				$this.addClass('error');
				submit = false;
			}
		}
	});
	contactForm.submit(function(){
		$('#firstName').valid();
		$('#lastName').valid();
		$('#email').valid();

		if ($('.error').length > 0) { return false; }
	});

	if ($('body').hasClass('form-sent')) {
		if ($(window).width() > 800) {
			$('.greyscale').fadeIn();
		}
		contactForm.show();
	}
});
</script>

<?php get_footer(); ?>