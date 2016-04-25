<li class="artothek-ausstellung-item">
	<?php
	$thumb = '';
	$width = (int) apply_filters('et_project_image_width',240);
	$height = (int) apply_filters('et_project_image_height',240);
	$classtext = '';
	$titletext = get_the_title();
	$thumbnail = get_thumbnail($width, $height, $classtext, $titletext, $titletext, false, 'Indeximage');
	$thumb = $thumbnail["thumb"];
	?>
	<div  style="clear:both">
		<div class="artothek-ausstellung-item">
			<a class="artothek-ausstellung-item-content artothek-icon-info fancybox" title="<?= $titletext ?>" href="<?= $thumb ?>" rel="<?php the_ID(); ?>">
				<img src="<?= $thumb ?>" alt="<?= $titletext ?>"/>
			</a><br />
			<a href="<?= get_permalink() ?>" rel="<?php the_ID(); ?>" class="artothek-icon artothek-icon-info">
				<?= $titletext ?>
			</a>
		</div>
	</div>
	<div style="clear:both;width:100%; height:1px"></div>
</li>