<?php
/*
Template Name: About
*/
?>

<?php get_header(); ?>

<div id="content">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<section class="hero">
			<?php the_content(); ?>
		</section>
	<?php endwhile; endif; ?>
	<div id="inner-content" class="wrap clearfix about-us">
		<ul class="codelib-admins">
	<?php

	// Get the authors from the database ordered by user nicename
		global $wpdb;
		$query = "SELECT ID, user_nicename from $wpdb->users ORDER BY -user_nicename";
		$author_ids = $wpdb->get_results($query);

	// Loop through each author
		foreach($author_ids as $author) :

		// Get user data
			$curauth = get_userdata($author->ID);

		// If user level is above 0 or login name is "admin", display profile
			if($curauth->user_level > 5 && $curauth->user_level < 8) :

			// Get link to author page
				$user_link = get_author_posts_url($curauth->ID);

			// Set default avatar (values = default, wavatar, identicon, monsterid)
				$avatar = 'wavatar';
	?>
	<li class="admin-user">
		<a href="<?php echo $user_link; ?>" title="<?php echo $curauth->display_name; ?>" class="user-avatar">
			<?php echo get_avatar($curauth->user_email, '200', $avatar); ?>
		</a>

		<section class="user-info">
			<h2 class="user-name"><?php echo $curauth->display_name; ?>
		
			<?php if(get_the_author_meta('twitter')) : ?>
						<a href="http://twitter.com/<?php echo get_the_author_meta('twitter'); ?>" title="Visit <?php echo $user->display_name; ?>'s Twitter account" class="twitter">
						    @<?php echo get_the_author_meta('twitter'); ?>
						</a>
			<?php endif; ?>
			</h2>
			<?php echo $curauth->description; ?>
		</section>
	</li>
		<?php endif; ?>

	<?php endforeach; ?>
</ul>
</div>

<?php get_footer(); ?>
