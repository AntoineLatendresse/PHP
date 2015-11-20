<?php
/**
 * Created by Latendresse Antoine && Yannick Delaire.
 * Date: 11/16/15
 */
require('createThumbnail.php');
$ct = new createThumbnail();
$total_image = count($_FILES['image']['name']);
for($i = 0; $i < $total_image; $i++)
{
    $ct->start($_FILES['image'], $i);
    $ct->extensionControl();
    $ct->isUpload();
    $new_name = rand(0,999).time().'.jpg';
    $ct->newName($new_name);
    $ct->moveUpload('images/');
    $ct->create_thumbnail('upload/thumb/', 'thumb_'.$new_name, 200, 150 );
}
$ct->result('SUCCESS MESSAGE');
?>