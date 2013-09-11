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

				<div id="inner-content" class="wrap clearfix events-classes">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

								<header class="article-header event-header">

									<h1 class="single-title custom-post-type-title event-title"><?php the_title(); ?></h1>
									<?php if( eo_is_all_day() ){
										$date_format = 'F j, Y'; 
									}else{
										$date_format = 'F j, Y @ ' . get_option('time_format'); 
									} ?>
									<section class="event-entry-meta">

										<!-- Output the date of the occurrence-->
										<?php
										//Format date/time according to whether its an all day event.
										//Use microdata http://support.google.com/webmasters/bin/answer.py?hl=en&answer=176035
											 $event_ID = get_the_ID();
											 $dateformat = ( get_option('date_format'));
											 if( eo_reoccurs($event_ID) ){
											 $recurring_format = ' l\s'.' @ '.get_option('time_format');
											}else{
											 $recurring_format = ' @ '.get_option('time_format');
											}
											$startdate = eo_get_the_start($dateformat, $event_ID);
											if( eo_get_the_start($dateformat, $event_ID) == eo_get_the_end($dateformat, $event_ID)){
												$enddate = "";
											}else {
												$enddate = ' - '.eo_get_the_end($dateformat, $event_ID);
											}
										?>
									 	<span class="event-date"><?php echo $startdate.$enddate;?></span>
										<span class="event-time"><?php eo_the_start($recurring_format);?></span>
			
									</section><!-- .event-entry-meta -->
								</header> <!-- end article header -->

								<section class="entry-content clearfix">

									<!-- The content or the description of the event-->
									<?php the_content(); ?>
									<!-- Get event information, see template: event-meta-event-single.php -->
									<?php eo_get_template_part('event-meta','event-single'); ?>
									<?php $registration_link = get_post_meta($event_ID,'registration_link', true);
									if ($registration_link) {
										echo '<a href="'.$registration_link.'" class="button">Register now</a>';
									} ?>
									
								</section> <!-- end article section -->
								

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

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

<?php get_footer(); ?>
