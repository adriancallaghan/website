<?php get_header(); ?>

    <div class="row-fluid" role="main">

	<?php if (have_posts()) : ?>

		<h2>Search Results</h2>

		<?php while (have_posts()) : the_post(); ?>

                    <div <?php post_class() ?>>
                            <h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
                            <small><?php the_time('l, F jS, Y') ?></small>

                            <p class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); ?> Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
                    </div>

		<?php endwhile; ?>

	<?php else : ?>
		<h2 class="center">No posts found. Try a different search?</h2>
	<?php endif; ?>

    </div>

<?php get_footer(); ?>
