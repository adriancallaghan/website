<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">    
    <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />        	
    <!--[if gte IE 9]>
        <style type="text/css">
          .gradient {
             filter: none;
          }
        </style>
    <![endif]-->
    <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
    <script src="<?php bloginfo('stylesheet_directory'); ?>/bezier.js"></script>

    <?php wp_head(); ?>
    
</head>
<body>
        <canvas id="c1" width="1" height="2" class="gradient"></canvas>
        <canvas id="c2" width="1" height="2"></canvas>
        
        <div class="container">

            <div class="masthead">
              <h4 class="muted"><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h4>
              <h4 class="muted"><?php bloginfo('description'); ?></h4>
              <div class="navbar">
                <div class="navbar-inner">
                  <div class="container">
                    <ul class="nav"> 
                     <?php wp_list_pages('title_li=' . __('')); ?>
                     <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">Categories <b class="caret"></b></a>
                        <ul class="dropdown-menu">                          
                            <?php wp_list_categories('title_li=' . __('')); ?>
                        </ul>
                      </li>                            
                    </ul>
                    <form class="form-search navbar-form pull-right">
                      <div class="input-append">
                          <input type="text" class="span2 search-query">
                          <button type="submit" class="btn">Search</button>
                      </div>
                    </form> 
                  </div>
                </div>
              </div><!-- /.navbar -->
            </div>

            <hr>
