<?php
/**
 * The template is used for displaying a single event details.
 *
 * You can use this to edit how the details re displayed on your site. (see notice below).
 *
 * Or you can edit the entire single event template by creating a single-event.php template
 * in your theme.
 *
 * For a list of available functions (outputting dates, venue details etc) see http://wp-event-organiser.com/documentation/function-reference/
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
 * @since 1.7
 */
?>

<div class="entry-meta eventorganiser-event-meta">
	<!-- Choose a different date format depending on whether we want to include time -->
	<?php if( eo_is_all_day() ){
		$date_format = 'F j, Y'; 
	}else{
		$date_format = 'F j, Y' . get_option('time_format'); 
	} ?>
	<!-- Event details -->
	
		
		<!-- Does the event have a venue? -->
		<?php if( eo_get_venue() ): ?>
			<!-- Display map -->
			<div id="test">
			<?php echo eo_get_venue_map(eo_get_venue(),array('width'=>'100%')); ?>
			</div>
		<?php endif; ?>


</div><!-- .entry-meta -->
