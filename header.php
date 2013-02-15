<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js gt-ie9"> <!--<![endif]-->
<?php
// are we coming here from the contact form being submitted?
if (isset($_GET['form']) && $_GET['form'] == 'sent') {
    $sent = 'form-sent';
}
?>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        
        <title><?php wp_title(''); ?></title>

        <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width" />

        <link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/favicon.ico" />

        <link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/style.css">
        <link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/css/style.css">
        <!--[if lt IE 9]><link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/css/ie.css"><![endif]-->
        
        <script src="<?php echo bloginfo('template_url'); ?>/js/vendor/modernizr.js"></script>
    <?php wp_head(); ?>
    </head>
    <body <?php body_class('preload'.' '.$sent); ?>>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
        <![endif]-->
    <div id="namespace" class="hidden"><?php echo home_url(); ?></div>
    <header id="header" role="banner">
    <?php if (is_front_page()) { ?>
        <h1 class="visuallyhidden">B &amp; R Auto &amp; Truck Salvage</h1>
    <?php } else { ?>
        <h3 class="visuallyhidden">B &amp; R Auto &amp; Truck Salvage</h3>
    <?php } ?>
    
        <?php 
        $title = get_the_title($post->ID); 
        $pages_left = array(
            // Order is reversed since pages are floating right
            'Contact Us' => 'contact',
            'About' => 'about',
            );
        $pages_right = array(
            'Services' => 'services',
            'Featured Sales' => 'featured-sales',
            ); ?>
        <section>
            <div class="left"> 
                <?php foreach ($pages_left as $page => $slug) { ?>
                    <a href="<?php echo home_url().'/'.$slug; ?>" title="<?php echo $page; ?>"
                        <?php echo 'class="'; if ($page == $title) { echo 'current '; } echo $slug.'-link "'; ?>
                        >
                        <?php echo $page; ?>
                    </a>
                <?php }
                ?>
            </div><!-- .left -->
            <div class="center">
                <a class="logo" href="<?php echo home_url(); ?>">
                    <img alt="B &amp; R Auto &amp; Truck Salvage" src="<?php echo bloginfo('template_url'); ?>/images/logo.png" />
                </a>
            </div>
            <div class="right">
                <?php foreach ($pages_right as $page => $slug) { ?>
                    <a href="<?php echo home_url().'/'.$slug; ?>" title="<?php echo $page; ?>"
                        <?php if ($page == $title) { echo 'class="current"'; } ?>
                        >
                        <?php echo $page; ?>
                    </a>
                <?php }
                ?>
            </div><!-- .right -->
        </section>

    </header>

    <div id="main" role="main" <?php post_class('clearfix'); ?>>