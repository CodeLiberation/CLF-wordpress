<?php
/*
This is the custom post type post template.
If you edit the post type name, you've got
to change the name of this template to
reflect that name change.

i.e. if your custom post type is called
register_post_type( 'bookmarks',
then your single template should be
single-bookmarks.php

*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

						<div id="main" class="clearfix" role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

								<header class="article-header">

									<h1 class="single-title custom-post-type-title"><?php the_title(); ?></h1>

								</header> <!-- end article header -->

								<section class="entry-content clearfix">

									<!-- Get event information, see template: event-meta-event-single.php -->
									<?php eo_get_template_part('event-meta','event-single'); ?>

									<!-- The content or the description of the event-->
									<?php the_content(); ?>
									
								</section> <!-- end article section -->

								<footer class="entry-meta">
								<?php
									//Events have their own 'event-category' taxonomy. Get list of categories this event is in.
									$categories_list = get_the_term_list( get_the_ID(), 'event-category', '', ', ',''); 

									if ( '' != $categories_list ) {
										$utility_text = __( 'See more in the same category: %1$s - <a href="%2$s" title="Permalink to %3$s" rel="bookmark">Permalink</a>', 'eventorganiser' );
									} else {
										$utility_text = __( 'This event was posted by <a href="%5$s">%4$s</a>. Bookmark the <a href="%2$s" title="Permalink to %3$s" rel="bookmark">permalink</a>.', 'eventorganiser' );
									}
									printf($utility_text,
										$categories_list,
										esc_url( get_permalink() ),
										the_title_attribute( 'echo=0' ),
										get_the_author(),
										esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )
									);
								?>

								<?php edit_post_link( __( 'Edit'), '<span class="edit-link">', '</span>' ); ?>
								</footer><!-- .entry-meta -->
								

							</article> <!-- end article -->

							<?php endwhile; ?>

							<?php else : ?>

									<article id="post-not-found" class="hentry clearfix">
										<header class="article-header">
											<h1><?php _e("Oops, Post Not Found!", "bonestheme"); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e("Uh Oh. Something is missing. Try double checking things.", "bonestheme"); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e("This is the error message in the single-custom_type.php template.", "bonestheme"); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div> <!-- end #main -->

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

<?php get_footer(); ?>
