<?php
/**
 * The template for displaying the venue page
 *
 ***************** NOTICE: *****************
 *  Do not make changes to this file. Any changes made to this file
 * will be overwritten if the plug-in is updated.
 *
 * To overwrite this template with your own, make a copy of it (with the same name)
 * in your theme directory. See http://wp-event-organiser.com/documentation/editing-the-templates/ for more information
 *
 * WordPress will automatically prioritise the template in your theme directory.
 ***************** NOTICE: *****************
 *
 * @package Event Organiser (plug-in)
 * @since 1.0.0
 */

//Call the template header
get_header(); ?>

<!-- This template follows the TwentyTwelve theme-->
<div id="primary" class="site-content">
	<div id="content" role="main">
<div id="inner-content" class="events-classes">
	<!-- Page header, display venue title-->
	<header class="page-header">	
		
		<?php $venue_id = get_queried_object_id(); ?>
		
		<h1 class="page-title"><?php printf( __( 'Events at %s', 'eventorganiser' ), '<span>' .eo_get_venue_name($venue_id). '</span>' );?></h1>

		<?php if( $venue_description = eo_get_venue_description( $venue_id ) ){
			 echo '<div class="venue-archive-meta">'.$venue_description.'</div>';
		} ?>
		
		<!-- Display the venue map. If you specify a class, ensure that class has height/width dimensions-->
		<?php echo eo_get_venue_map( $venue_id, array('width'=>"100%") ); ?>
	</header><!-- end header -->

	<?php if ( have_posts() ) : ?>

		<!-- Navigate between pages -->
		<!-- In TwentyEleven theme this is done by twentyeleven_content_nav -->
		<?php 
			if ( $wp_query->max_num_pages > 1 ) : ?>
				<nav id="nav-above">
					<div class="nav-next events-nav-newer"><?php next_posts_link( __( 'Later events <span class="meta-nav">&rarr;</span>' , 'eventorganiser' ) ); ?></div>
					<div class="nav-previous events-nav-newer"><?php previous_posts_link( __( ' <span class="meta-nav">&larr;</span> Newer events', 'eventorganiser' ) ); ?></div>
				</nav><!-- #nav-above -->
		<?php endif; ?>
<ul class="events-classes-list">
		<!-- This is the usual loop, familiar in WordPress templates-->
		<?php while ( have_posts()) : the_post(); ?>
	
			<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="event-header">

				<h3 class="event-title">
				<a href="<?php the_permalink(); ?>">
					<?php 
						//If it has one, display the thumbnail
						if( has_post_thumbnail() )
							the_post_thumbnail('thumbnail', array('style'=>'float:left;margin-right:20px;'));

						//Display the title
						the_title()
					;?>
				</a>
				</h3>
		
				<span class="event-entry-meta event-date">

					<!-- Output the date of the occurrence-->
					<?php
					//Format date/time according to whether its an all day event.
					//Use microdata http://support.google.com/webmasters/bin/answer.py?hl=en&answer=176035
					  $dateformat = ( get_option('date_format'));
					 if( eo_reoccurs() ){
					 $recurring_format = 'l\s'.' @ '.get_option('time_format');
				 	}else{
					 $recurring_format = ' @ '.get_option('time_format');
				 	}
					
					if( eo_the_start($dateformat) == eo_the_end($dateformat)){
						$enddate = "";
					}else {
						$enddate = '- '.eo_get_the_end($dateformat, $event->ID,null,$event->occurrence_id);
					}
					?>
				 	<span class="event-date"><?php eo_the_start($recurring_format);?></span>
			
				</span><!-- .event-entry-meta -->
		
				<div style="clear:both;"></div>
			</header><!-- .entry-header -->
			<article class="event-desc">
				<?php the_content(); ?>
			</article>
			<?php
			$event_category =  get_the_term_list(get_the_ID(),'event-category', '', ', ','');
			$btn_text = strip_tags($event_category);
			echo '<a class="button" href="%s">Join this '.$btn_text.'</a>'; 
			?>
			</li><!-- #post-<?php the_ID(); ?> -->

    		<?php endwhile; ?><!--The Loop ends-->
		</ul>
			<!-- Navigate between pages-->
			<?php 
			if ( $wp_query->max_num_pages > 1 ) : ?>
				<nav id="nav-below">
					<div class="nav-next events-nav-newer"><?php next_posts_link( __( 'Later events <span class="meta-nav">&rarr;</span>' , 'eventorganiser' ) ); ?></div>
					<div class="nav-previous events-nav-newer"><?php previous_posts_link( __( ' <span class="meta-nav">&larr;</span> Newer events', 'eventorganiser' ) ); ?></div>
				</nav><!-- #nav-below -->
			<?php endif; ?>


	<?php else : ?>
			<!-- If there are no events -->
			<article id="post-0" class="post no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Nothing Found', 'eventorganiser' ); ?></h1>
				</header><!-- .entry-header -->
				<div class="entry-content">
					<p><?php _e( 'Apologies, but no events were found for the requested venue. ', 'eventorganiser' ); ?></p>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->
	<?php endif; ?>
</div>
	</div><!-- #content -->
</div><!-- #primary -->

<!-- Call template sidebar and footer -->
<?php get_footer(); ?>
