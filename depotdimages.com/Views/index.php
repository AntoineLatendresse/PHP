<?php
include_once("../Controller/functions.php");
showHeader();
define("LOGOUT", "../Controller/controller_logout.php");
define("LOGIN", "../Controller/controller_login.php");
/**
 * Created by Latendresse Antoine && Yannick Delaire.
 * Date: 11/16/15
 */
//DisplayImage
function getImages()
{
    $dir = "../images/";
    $file_names = '';
    if(is_dir($dir))
    {
        if($dh = opendir($dir))
        {
            while(($file = readdir($dh)) !== false)
            {
                if($file === '.' || $file === '..') continue;
                echo '<img src="../images/'.$file.'" width="200 height="150" alt="">';
                $file_names .=$file. '<br>';
            }
            closedir($dh);
        }
    }
    return $file_names;
}
?>
<?php
//UploadImage
if(isset($_POST['upload_img']))
{
    $file_name = $_FILES['image']['name'];
    $file_type = $_FILES['image']['type'];
    $file_type = $_FILES['image']['size'];
    $file_tmp_name = $_FILES['image']['tmp_name'];

    if(move_uploaded_file($file_tmp_name, "images/$file_name"))
    {
        echo 'Image is uploaded !';
    }
}
?>
<?php
//DeleteImage
if(isset($_POST['delete_img']))
{
    $img_file = $_POST['filename'];
    if($img_file)
    {
        unlink("images/$img_file");
        header("Refresh:0");
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>All your photos organized and easy to find</title>
    <link href="../Styles/style.css" rel="stylesheet" media="all" type="text/css">
    <link rel="stylesheet" type="text/css" media="screen" href="http://cdnjs.cloudflare.com/ajax/libs/fancybox/1.3.4/jquery.fancybox-1.3.4.css" />
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
    $file_names = getImages();
    echo '<br>'.'<br>'.$file_names;
    ?>
    <br/><br/><br/><br/><br/>
</div>
<div class="wrap">
    <h1>Upload your photos: </h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="image"/>
        <input class="button" type="submit" value="Upload Image" name="upload_img" />
    </form>
</div>
<div class="wrap">
<form action="" method="post">

    <h1>Delete your photos: </h1>
    <input type="text" name="filename" title=""/>
    <input type="submit" value="Delete Image" name="delete_img"/>
</form>
</div>
<div class="wrap">
    <a href="<?php echo LOGIN?>">
        <input  type="submit" value="Se connecter..." class="button" />
    </a>
    <a href="<?php echo LOGOUT?>">
        <input  type="submit" value="Se deconnecter..." class="button" />
    </a>
</div>
</body>
</html>
<?php
showFooter();
?>