<?php
global $wpdb;

if(isset($_POST["id_1"])) {
  $i = 1;
  while(isset($_POST["id_".$i])) {
    $url = esc_sql($_POST["img_".$i]);
    $pid = esc_sql($_POST["id_".$i]);
    $wpdb->query("UPDATE $wpdb->nggpictures SET videourl = '$url' WHERE pid = $pid");
    $i++;
  }
}
 ?>

<h2>NGG Video</h2>
<div class="metabox-holder">
  <div class="postbox">
    <h3 class="hndle ui-sortable-handle" style="cursor: default">How to use the plugin</h3>
    <ol>
      <li>Select a NextGen Gallery and click on "Select".</li>
      <li>Then define a video url for every image which should be a video.</li>
      <li>After that click on "Save".</li>
      <li>Now go to the location where you want your video gallery.</li>
      <li>Use the following shortcode to add a gallery as video gallery:<br />
      <pre>[nggallery id=<?php echo (isset($_GET['gid'])) ? $_GET['gid'] : "YOUR_GALLERY_ID"; ?> template="nggvideo"]</pre></li>
      <li>Save the page and enjoy your video gallery.</li>
    </ol>
  </div>
  <div>
    <form action="" method="get">
      <span>Select an NGG Gallery:</span>
      <input type="hidden" name="page" value="<?php echo $_GET['page']; ?>" />
      <select name="gid" style="min-width: 100px;">
<?php
$allGalleries = $wpdb->get_results( "SELECT gid, name FROM $wpdb->nggallery" );
$currentId = $_GET['gid'];
foreach($allGalleries as $gallery) {
  $attributes = "value=\"$gallery->gid\"";
  if($currentId == $gallery->gid) {
    $attributes .= " selected";
  }
?>
        <option <?php echo $attributes; ?>><?php echo $gallery->name ?></option>
<?php
}
?>
      </select>
      <input class="button-secondary" type="submit" value="Select"/>
    </form>
  </div>
<?php
if(isset($currentId)) {
?>
  <form method="post" accept-charset="utf-8" action="<?php echo basename($_SERVER['REQUEST_URI']); ?>">
<?php
  $galleryPictures = $wpdb->get_results("SELECT * FROM $wpdb->nggpictures WHERE galleryid = ".$currentId);
  $noImg = 0;
  foreach($galleryPictures as $picture) {
    $storage = C_Gallery_Storage::get_instance();
    $dimension = $storage->get_image_dimensions($picture, "thumb");
    $noImg++;
?>
    <div style="margin: 20px 0 10px 0;">
      <div style="margin-right: 20px; width: <?php echo $dimension['width'];?>px; height: <?php echo $dimension['height'];?>px; overflow: hidden; display: inline-block; vertical-align: middle; background: url(<?php echo $storage->get_image_url($picture, "thumb", false, true); ?>)">
        <div style="padding: 0 2px; color: black; background-color: white; opacity: 0.7"><?php echo $picture->filename . ":"; ?></div>
      </div>
      <div style="min-width: 300px; width: 70%; display: inline-block;">
        <span style="width: 30px;">URL: </span>
        <input name="id_<?php echo $noImg; ?>" value="<?php echo $picture->pid; ?>" type="hidden">
        <input name="img_<?php echo $noImg; ?>" type="text" value="<?php echo $picture->videourl; ?>" style="min-width:270px; width: 80%;"/>
      </div>
    </div>
<?php
  }
?>
    <input class="button-secondary" type="submit" value="Save" />
  </form>
<?php
}
?>
</div>