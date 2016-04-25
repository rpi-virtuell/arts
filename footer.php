<?php if (is_home()  && false) : ?>
		<div id="pre-footer">
			<div class="container">
				<p class="tagline"><?php bloginfo('description'); ?></p>
				<br />
				<?php et_vertex_action_button(); ?>
			</div>
		</div> <!-- #pre-footer -->
<?php endif; ?>

<footer id="main-footer">
	<div class="container">
		<?php get_sidebar('footer'); ?>
		<p id="footer-info">
			<a href="http://rpi-virtuell.net/artothek">Inspiriert durch die Artothek von rpi-virtuell</a> | 
			<a href="/impressum">Impressum</a>
		</p>
	</div> <!-- .container -->
</footer> <!-- #main-footer -->


<?php wp_footer(); ?>
</body>
</html>