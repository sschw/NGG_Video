<?php 
/**
Template Page for the gallery overview

Follow variables are useable :

	$gallery     : Contain all about the gallery
	$images      : Contain all images, path, title
	$pagination  : Contain the pagination content

 You can check the content when you insert the tag <?php var_dump($variable) ?>
 If you would like to show the timestamp of the image ,you can use <?php echo $exif['created_timestamp'] ?>
**/
?>
<?php if (!defined ('ABSPATH')) die ('No direct access allowed'); ?><?php if (!empty ($gallery)) : ?>
<?php
global $wp_embed;
 ?>
<div class="ngg-galleryoverview" id="<?php echo $gallery->anchor ?>">

	<!-- Thumbnails -->
  <?php $i = 0; ?>
	<?php foreach ( $images as $image ) :
    $array = array();
    if(preg_match("/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/", $image->videourl, $array))
      $cleanVideoUrl = $array[0];
  ?>
	
	<div id="ngg-image-<?php echo $image->pid ?>" class="ngg-gallery-thumbnail-box" <?php echo $image->style ?> >
		<div class="ngg-gallery-thumbnail nggvideo-thumbnail" >
			<a href="<?php echo nextgen_esc_url($image->imageURL) ?>"
               title="<?php echo esc_attr($image->description) ?>"
               <?php echo $image->thumbcode." data-videourl='". $cleanVideoUrl ."' data-video='".str_replace("'", "\"", do_shortcode($wp_embed->autoembed($image->videourl)))."' "; ?> >
				<?php if ( !$image->hidden ) { ?>
				<img title="<?php echo esc_attr($image->alttext) ?>" alt="<?php echo esc_attr($image->alttext) ?>" src="<?php echo nextgen_esc_url($image->thumbnailURL) ?>" <?php echo $image->size ?> />
				<?php } ?>
			</a>
		</div>
	</div>

    <?php if ( $image->hidden ) continue; ?>
    <?php if ($gallery->columns > 0): ?>
        <?php if ((($i + 1) % $gallery->columns) == 0 ): ?>
            <br style="clear: both" />
        <?php endif; ?>
    <?php endif; ?>
    <?php $i++; ?>

 	<?php endforeach; ?>
 	
	<!-- Pagination -->
 	<?php echo $pagination ?>
 	
</div>

<?php endif; ?>
