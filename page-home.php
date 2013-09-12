<?php
/*
Template Name: Home Page
*/
?>

<?php get_header('home'); ?>

			<div id="content">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<section class="hero">
						<?php the_content(); ?>
					</section>
				<?php endwhile; endif; ?>
				<?php get_sidebar(); ?>
				<div id="inner-content" class="wrap clearfix">

					<section class="entry-content events-classes clearfix" itemprop="articleBody">
						<header class="article-header index-hero">
							<h2><?php the_field('events_&_classes_header_text'); ?></h2>
						</header> <!-- end article header -->
						<?php
						 $events = eo_get_events(array(
						         'numberposts'=>3,
						         'event_start_after'=>'today',
						         'showpastevents'=>true,//Will be deprecated, but set it to true to play it safe.
						    ));

						  if($events):
						     echo '<ul class="events-classes-list">';
						     foreach ($events as $event):
						          //Check if all day, set format accordingly
						          $dateformat = ( get_option('date_format'));
									 if( eo_reoccurs($event->ID) ){
									 $recurring_format = 'l\s'.' @ '.get_option('time_format');
								 	}else{
  									 $recurring_format = get_option('time_format');
								 	}
								   $post_object = get_post($event->ID);
									setup_postdata($post_object);
								   $description = get_the_excerpt();
									$event_category =  get_the_term_list( $event->ID, 'event-category', '', ', ','');
									$btn_text = strip_tags($event_category);
						          printf(
						             '<li>
											<h3 class="event-title"><a href="%s">%s</a></h3>
										 	<section class="event-info">
											 	<span class="event-date">%s - %s</span>
												<span class="event-time">%s</span>
												<article class="event-desc">'.$description.'</article>
												<a class="button" href="%s">Join this '.$btn_text.'</a> 
											</section>
										 </li>',
						             get_permalink($event->ID),
						             get_the_title($event->ID),
						             eo_get_the_start($dateformat, $event->ID,null,$event->occurrence_id),
										 eo_get_the_end($dateformat, $event->ID,null,$event->occurrence_id),
						             eo_get_the_start($recurring_format, $event->ID,null,$event->occurrence_id),
										 get_permalink($event->ID)
						          );
						     endforeach;
						     echo '</ul>';
						  endif;
						 ?>
						<footer>
							<a href="<?php echo home_url(); ?>/events-classes"><?php the_field('events_&_classes_link'); ?></a> <!-- - <a href="#"><?php the_field('video_tutorials_link'); ?></a> -->
						</footer>
					</section> <!-- end article section -->
					
					<section class="entry-content about clearfix" itemprop="articleBody">
						<header class="article-header index-hero">
							<h2><?php the_field('about_our_classes_header_text'); ?></h2>
						</header> <!-- end article header -->
						<article class="area-content">
							<?php the_field('about_our_classes_content'); ?>
						</article>
						<footer>
							<!-- <a href="<?php echo home_url(); ?>/about"><?php the_field('about_our_teachers_link'); ?></a> -->
							<span class="fine-print"><?php the_field('about_our_classes_fine_print'); ?></span>
						</footer>
					</section> <!-- end article section -->
					
					<section class="entry-content social-media clearfix" itemprop="articleBody">
						<header class="article-header index-hero">
							<h2><?php the_field('social_media_header_text'); ?></h2>
						</header> <!-- end article header -->
						<article class="area-content">
							<?php the_field('social_media_twitter_shortcode'); ?>
						</article>
						<footer>
							<?php the_field('social_media_links'); ?>
						</footer>
					</section> <!-- end article section -->

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

<?php get_footer('home'); ?>
