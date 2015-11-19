<?php
/**
 * Created by Latendresse Antoine && Yannick Delaire.
 * Date: 11/16/15
 */
$imagetypes = array("image/jpeg", "image/gif");
function getImages($dir)
{
    global $imagetypes;

    // array to hold return value
    $retval = array();

    // add trailing slash if missing
    if(substr($dir, -1) != "/") $dir .= "/";

    // full server path to directory
    $fulldir = "{$_SERVER['DOCUMENT_ROOT']}/$dir";

    $d = @dir($fulldir) or die("getImages: Failed opening directory $dir for reading");
    while(false !== ($entry = $d->read())) {
        // skip hidden files
        if($entry[0] == ".") continue;

        // check for image files
        $f = escapeshellarg("$fulldir$entry");
        if(in_array($mimetype = trim( `file -bi $f` ), $imagetypes)) {
            $retval[] = array(
                "file" => "/$dir$entry",
                "size" => getimagesize("$fulldir$entry")
            );
        }
        foreach($imagetypes as $valid_type) {
            if(preg_match("@^{$valid_type}@", $mimetype)) {
                $retval[] = array(
                    'file' => "/$dir$entry",
                    'size' => getimagesize("$fulldir$entry")
                );
                break;
            }
        }
    }
    $d->close();

    return $retval;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>All your photos organized and easy to find</title>
    <link href="style.css" rel="stylesheet" media="all" type="text/css">
</head>

<body>
<div class="wrap">
    <?php
    // fetch image details
    $images = getImages("images");

    // display on page
    foreach($images as $img) {
        echo "<div class=\"photo\">";
        echo "<a href=\"{$img['file']}\" target=\"_blank\"><img width=\"200\" height=\"150\" src=\"{$img['file']}\" {$img['size'][3]} alt=\"\" title=",basename($img['file'])," </a><br />";
    }
    ?>
    <h1>Upload your photos: </h1>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="image[]" multiple/>
        <input class="button" type="submit" value="Upload" />
    </form>
</div>
</body>
</html>