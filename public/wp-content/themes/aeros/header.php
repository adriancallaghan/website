<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
        <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
				<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
				<meta name="description" content="Home of Adrian Callaghan BSC(Hons) Blog site. Programmer and Computer Scientist, Lived in luton for many years and currently working in Beford for THUK-Media">
        <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
        <link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
        <link rel="alternate" type="application/atom+xml" title="Atom 1.0" href="<?php bloginfo('atom_url'); ?>" />
        <link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('url'); ?>/wp-content/themes/aeros/favicon.ico" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <?php wp_get_archives('type=monthly&format=link'); ?>
        <?php //comments_popup_script(); // off by default ?>
        <?php wp_head(); ?>
        <style type="text/css" media="screen">
                @import url( <?php bloginfo('stylesheet_url'); ?> );
        </style>



</head>

<body>

<div id="rap">

<div id="headmenu">

<?php if (is_search() || is_404()) { ?>
        <ul>
        <?php wp_list_pages('depth=1&sort_column=menu_order&title_li='); ?>
        <li><a href="<?php echo get_settings('home'); ?>/" title="Home">Home</a></li>
        </ul>
<?php } else { ?>
        <ul>
                <?php wp_list_pages('depth=1&sort_column=menu_order&title_li='); ?>
<?php
        if($post->post_parent)
                $children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0"); else
                $children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
        if ($children) { ?>

                <?php echo $children; ?>
                <?php } ?>

        <li><a href="<?php echo get_settings('home'); ?>/" title="Home">Home</a></li>
        </ul>
<?php } ?>


</div><!-- end headmenu -->

<div id="header">

<div id="headerleft">
<h1><a href="<?php bloginfo('url'); ?>/"><?php bloginfo('name'); ?></a></h1>
<h2><?php bloginfo('description'); ?></h2>
</div><!-- end headerleft -->

<div id="headerright">
<a href="<?php bloginfo('rss_url'); ?>" title="GET MY FEED"></a>
</div><!-- end headerright -->

</div><!-- end header -->


<div id="content">