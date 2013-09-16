<div id="sidebars">

<div id="sidebar_full">
<ul>

 <!--li>
<?php //include (TEMPLATEPATH . '/welcome.php'); ?>
 </li-->



<?php 
/*
// Poll addition
if (function_exists('vote_poll') && !in_pollarchive()): ?>
<li>
 <div class="sidebarbox">
 <h2>Polls</h2>
   <ul>
      <li><?php get_poll();?></li>
   </ul>
   <?php display_polls_archive_link(); ?>
	</div>
</li>
<?php endif; */ ?> 


<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar_full') ) : ?>

 <li>
 <div class="sidebarbox">
 <h2>Recent Posts</h2>
 <ul>
  <?php wp_get_archives('type=postbypost&limit=10'); ?>
 </ul>
 </div>
 </li>

 <li>
 <div class="sidebarbox">
 <h2>Browse by tags</h2>
 <?php wp_tag_cloud('smallest=8&largest=17&number=30'); ?>
 </div>
 </li>

<?php endif; ?>

</ul>
</div><!-- Closes Sidebar_full -->


<div id="sidebar_left">
<ul>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar_left') ) : ?>

<li>
<div class="sidebarbox">
<h2>Categories</h2>
<ul>
  <?php wp_list_categories('show_count=0&title_li='); ?>
</ul>
</div>
</li>

<?php endif; ?>
</ul>

</div> <!-- Closes Sidebar_left -->

<div id="sidebar_right">

<ul>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar_right') ) : ?>

<li>
<div class="sidebarbox">
<h2>Pages</h2>
<ul>
  <?php wp_list_pages('depth=1&title_li=0&sort_column=menu_order'); ?>
</ul>
</div>
</li>

<?php endif; ?>
</ul>

</div> <!-- Closes Sidebar_right -->


<div class="cleared"></div>
</div> <!-- Closes Sidebars -->