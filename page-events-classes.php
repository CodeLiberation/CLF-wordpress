<?php
/*
Template Name: Events & Classes
*/
?>

<?php get_header(); ?>

		<div id="content">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<section class="hero">
					<?php the_content(); ?>
				</section>
			<?php endwhile; endif; ?>
			<div id="inner-content" class="wrap clearfix events-classes">
			
							<?php
							 $events = eo_get_events(array(
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
	  									 $recurring_format = ' @ '.get_option('time_format');
									 	}
									   $post_object = get_post($event->ID);
									   $description = $post_object->post_content;
										$event_category =  get_the_term_list( $event->ID, 'event-category', '', ', ','');
										$btn_text = strip_tags($event_category);
							          printf(
							             '<li>
												 	<section class="event-header">
														<h3 class="event-title"><a href="%s">%s</a></h3>
													 	<span class="event-date">%s - %s</span>
														<span class="event-time">%s</span>
													</section>
													<article class="event-desc">'.$description.'</article>
													<a class="button" href="%s">Join this '.$btn_text.'</a> 
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
							
				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

<?php get_footer(); ?>
