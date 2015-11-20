<?php
/**
 * Created by Latendresse Antoine && Yannick Delaire.
 * Date: 11/16/15
 */
function getImages()
{
    $image_types = array(
        'gif' => 'image/gif',
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
    );
    $dir = "images/";
    foreach (scandir('images') as $entry) {
        if (!is_dir($entry)) {
            if (in_array(mime_content_type('images/'. $entry), $image_types)) {
                // do something with image
                echo "<img class=\"photo\" src='$dir$entry' width='150px'/>";
            }
        }
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>All your photos organized and easy to find</title>
    <link href="style.css" rel="stylesheet" media="all" type="text/css">
    <link rel="stylesheet" type="text/css" media="screen" href="http://cdnjs.cloudflare.com/ajax/libs/fancybox/1.3.4/jquery.fancybox-1.3.4.css" />
    <style type="text/css">
        a.fancybox img {
            border: none;
            box-shadow: 0 1px 7px rgba(0,0,0,0.6);
            -o-transform: scale(1,1); -ms-transform: scale(1,1); -moz-transform: scale(1,1); -webkit-transform: scale(1,1); transform: scale(1,1); -o-transition: all 0.2s ease-in-out; -moz-transition: all 0.2s ease-in-out; -webkit-transition: all 0.2s ease-in-out; transition: all 0.2s ease-in-out;
        }
        a.fancybox:hover img {
            position: relative; z-index: 999; -o-transform: scale(1.03,1.03); -ms-transform: scale(1.03,1.03); -moz-transform: scale(1.03,1.03); -webkit-transform: scale(1.03,1.03); transform: scale(1.03,1.03);
        }
    </style>
</head>

<body>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/fancybox/1.3.4/jquery.fancybox-1.3.4.pack.min.js"></script>
<script type="text/javascript">
    $(function($){
        var addToAll = true;
        var gallery = true;
        var titlePosition = 'over';
        $(addToAll ? 'img' : 'img.fancybox').each(function(){
            var $this = $(this);
            var title = $this.attr('title');
            var src = $this.attr('data-big') || $this.attr('src');
            var a = $("<a href=\"#\" class=\"fancybox\"></a>").attr('href', src).attr('title', title);
            $this.wrap(a);
        });
        if (gallery)
            $('a.fancybox').attr('rel', 'fancyboxgallery');
        $('a.fancybox').fancybox({
            titlePosition: titlePosition
        });
    });
    $.noConflict();
</script>
<div class="wrap">
    <h1>Your photos: </h1>
    <?php
    getImages();
    ?>
    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>
<div class="wrap">
    <h1>Upload your photos: </h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="image"/>
        <input class="button" type="submit" value="Upload Image" name="upload_img" />
        <input type="text" name="file_name" title="input"/>
        <input type="submit" value="Delete Image" name="delete_img"
    </form>
</div>
</body>
</html>