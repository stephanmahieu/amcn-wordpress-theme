<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

		</div><!-- #main -->

		<footer id="colophon" class="site-footer" role="contentinfo">

			<?php get_sidebar( 'footer' ); ?>

			<div class="site-info">
                Webmaster: <a href="mailto:<?php echo antispambot('webmaster@malamuteclub.com',1); ?>">Stephan Mahieu</a> | Copyright &copy; Alaska Malamute Club Nederland, <?php echo date('Y'); ?>. Alle rechten voorbehouden. | <a href="https://www.amcn.nl/algemeen/privacyverklaring/">Privacyverklaring</a>
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>
</body>
</html>