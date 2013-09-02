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

					<section class="entry-content clearfix" itemprop="articleBody">
						<header class="article-header index-hero">
						</header> <!-- end article header -->
					</section> <!-- end article section -->

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

<?php get_footer(); ?>
