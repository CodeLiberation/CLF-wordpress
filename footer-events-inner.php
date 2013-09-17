			<footer class="footer" role="contentinfo">

				<div id="inner-footer" class="wrap clearfix">
					<p class="source-org copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <a href="<?php echo home_url(); ?>/contact">Contact us</a></p>

					<nav role="navigation">
							<?php bones_footer_links(); ?>
					</nav>
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" class="paypal-button">
					<input type="hidden" name="cmd" value="_s-xclick">
					<input type="hidden" name="hosted_button_id" value="LD29NMBEPR5BN">
					<input type="image" src="http://www.devotiongallery.com/phoenix/donate.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
					<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
					</form>

				</div> <!-- end #inner-footer -->

			</footer> <!-- end footer -->

		</div> <!-- end #container -->

		<!-- all js scripts are loaded in library/bones.php -->
		<?php wp_footer(); ?>
		<script>
			var $ = jQuery;
			$(".top-nav").find("li:nth-child(1)").addClass("current_page_item");
		</script>
	</body>

</html> <!-- end page. what a ride! -->
