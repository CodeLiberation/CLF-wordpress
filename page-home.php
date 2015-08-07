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
                  <h2 class="video-title">Watch our video:</h2>
                  <div class="movie-wrapper">
                     <iframe class="clf-movie" src="//www.youtube.com/embed/3DQAvk9Jrc0" frameborder="0" allowfullscreen></iframe>
                  </div>
					</section>
				<?php endwhile; endif; ?>
				<?php get_sidebar(); ?>
				<div id="inner-content" class="wrap clearfix">

					<section class="entry-content events-classes clearfix" itemprop="articleBody">
						<header class="article-header index-hero">
							<h2><?php the_field('events_&_classes_header_text'); ?></h2>
						</header> <!-- end article header -->
						<footer>
							<a href="http://www.eventbrite.com/o/the-code-liberation-foundation-4653154663"><?php the_field('events_&_classes_link'); ?></a> <!-- - <a href="#"><?php the_field('video_tutorials_link'); ?></a> -->
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
							<ul>
								<li>
									<a href="<?php echo home_url(); ?>/about"><?php the_field('about_our_teachers_link'); ?></a>
								</li>
								<li>
									<a href="<?php echo home_url(); ?>/blog"><?php the_field('blog_link'); ?></a>
								</li>
							</ul>
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
