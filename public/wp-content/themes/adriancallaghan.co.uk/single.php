<?php get_header(); ?>
        
        
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <div class="row-fluid" role="main">
                <div class="span6"><p class='text-left'><?php previous_post_link('&laquo; %link') ?></p></div>
                <div class="span6"><p class='text-right'><?php next_post_link('%link &raquo;') ?></p></div>
            </div>

            <div class="row-fluid" role="main">
                <div id="post-<?php the_ID(); ?>" class="span12">
                    <h2><?php the_title(); ?></h2>
                    <?php the_content(); ?>
                    <?php the_tags( '<p>Tags: ', ', ', '</p>'); ?>

                        <small>
                            This entry was posted
                            <?php /* This is commented, because it requires a little adjusting sometimes.
                                    You'll need to download this plugin, and follow the instructions:
                                    http://binarybonsai.com/wordpress/time-since/ */
                                    /* $entry_datetime = abs(strtotime($post->post_date) - (60*120)); echo time_since($entry_datetime); echo ' ago'; */ ?>
                            on <?php the_time('l, F jS, Y') ?> at <?php the_time() ?>
                            and is filed under <?php the_category(', ') ?>.
                            You can follow any responses to this entry through the <?php post_comments_feed_link('RSS 2.0'); ?> feed.
                        </small>

                </div>
            </div>

	<?php comments_template(); ?>

	<?php endwhile; else: ?>
            <p>Sorry, no posts matched your criteria.</p>
        <?php endif; ?>

    </div>

<?php get_footer(); ?>
