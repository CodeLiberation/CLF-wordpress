<?php
/*
Template Name: About
*/
?>

<?php get_header('about'); ?>

<div id="content">
     <div id="about-content-top">
        Code Liberation was founded by Phoenix Perry and four women from various backgrounds who want to change the female-to-male ratio in video game development.
     </div>

	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

		<div class="post">
			<div class="entry">
				<?php the_content(); ?>
			</div>
		</div>

	<?php endwhile; endif; ?>

	<?php

	// Get the authors from the database ordered by user nicename
		global $wpdb;
		$query = "SELECT ID, user_nicename from $wpdb->users ORDER BY user_nicename";
		$author_ids = $wpdb->get_results($query);

	// Loop through each author
		foreach($author_ids as $author) :

		// Get user data
			$curauth = get_userdata($author->ID);

		// If user level is above 0 or login name is "admin", display profile
			if($curauth->user_level > 0 || $curauth->user_login == 'admin') :

			// Get link to author page
				$user_link = get_author_posts_url($curauth->ID);

			// Set default avatar (values = default, wavatar, identicon, monsterid)
				$avatar = 'wavatar';
	?>

	<div id="about-us">

		<a href="<?php echo $user_link; ?>" title="<?php echo $curauth->display_name; ?>">
			<?php echo get_avatar($curauth->user_email, '200', $avatar); ?>
		</a>

		<div id="about-us-title">
		<a href="<?php echo $user_link; ?>" title="<?php echo $curauth->display_name; ?>"><?php echo $curauth->display_name; ?></a>
		
		<?php if($user->twitter) : ?>
					<a href="http://twitter.com/<?php echo $user->twitter; ?>" title="Visit <?php echo $user->display_name; ?>'s Twitter account" class="twitter">
					    @<?php echo $user->twitter; ?>
					</a>
		<?php endif; ?>
		</div>

		<p>
			<?php echo $curauth->description; ?>
		</p>

	</div>

		<?php endif; ?>

	<?php endforeach; ?>
</div>

<?php get_footer(); ?>
