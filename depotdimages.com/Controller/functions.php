<?php
/**
 * Created by Latendresse Antoine && Yannick Delaire.
 * Date: 11/16/15
 */
define("LOGOUT", "../Controller/controller_logout.php");
define("LOGIN", "../Controller/controller_login.php");
define("PROFIL", "../Views/profil.php");
define("GESTIM", "../Views/gestimage.php");

function dbConnect()
{
    try
    {
        return new PDO('mysql:host=localhost;dbname=depotimages', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
}

function menu()
{
    if(isset($_SESSION['username']) && $_SESSION['username'] == 'Admin') {
        ?>
        <div id='cssmenu'>
            <ul>
                <?php if(!isset($_SESSION["connected"]) || $_SESSION[ "connected" ] == false)
                {
                    ?>
                    <li class='active'><a href="../Views/login.php">Login</a></li>
                    <?php
                }
                else
                {
                    ?>
                    <li><a href="../Controller/controller_logout.php">Logout</a></li>
                    <?php
                }
                ?>
                <li><a href="../Views/index.php">Gallery</a></li>
                <li><a href="../Views/profil.php">Profil</a></li>
                <li><a href="../Views/admin.php">Gestion</a></li>
                <li><?php if (isset($_SESSION['username'])) echo "Welcome:", $_SESSION['username']; ?></li>
            </ul>
        </div>
        <?php
    }
    else{
        ?>
        <div id='cssmenu'>
            <ul>
                <?php if(!isset($_SESSION["connected"]) || $_SESSION[ "connected" ] == false)
                {
                    ?>
                    <li class='active'><a href="../Views/login.php">Login</a></li>
                    <?php
                }
                else
                {
                    ?>
                    <li><a href="../Controller/controller_logout.php">Logout</a></li>
                    <?php
                }
                ?>
                <li><a href="../Views/index.php">Gallery</a></li>
                <li><a href="../Views/profil.php">Profil</a></li>
                <li><?php if (isset($_SESSION['username'])) echo "Welcome:", $_SESSION['username']; ?></li>
            </ul>
        </div>
        <?php
    }
}

function updateProfil($username, $newPassword, $firstName, $lastName)
{
    $query = dbConnect()->prepare("CALL UPDATE_PROFIL(?,?,?,?)");

    $query->bindParam(1, $username, PDO::PARAM_STR);
    $query->bindParam(2, $newPassword, PDO::PARAM_STR);
    $query->bindParam(3, $firstName, PDO::PARAM_STR);
    $query->bindParam(4, $lastName, PDO::PARAM_STR);

    $query->execute();

    $query->closeCursor();
}

function verifyConnected()
{
    if(empty($_SESSION['connected']))
    {
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '../Views/login.php');
        exit;
    }
    echo 'You will only see this if you are logged in.';
}

function getUser($username)
{
    $query = dbConnect()->prepare("CALL SELECT_USER(?)");

    $query->bindParam(1, $username, PDO::PARAM_STR);

    $query->execute();
    $result = $query->fetchAll();

    $query->closeCursor();

    return $result;
}

function getPassword($username)
{
    $query = dbConnect()->prepare("CALL SELECT_PASSWORD(?)");

    $query->bindParam(1, $username, PDO::PARAM_STR);

    $query->execute();
    $result = $query->fetchAll();

    $query->closeCursor();

    return $result[0][ "Pass_word" ];
}

function createUser($username, $password, $firstName, $lastName)
{
    $query = dbConnect()->prepare("CALL INSERT_USER(?,?,?,?)");

    $query->bindParam(1, $username, PDO::PARAM_STR);
    $query->bindParam(2, $password, PDO::PARAM_STR);
    $query->bindParam(3, $firstName, PDO::PARAM_STR);
    $query->bindParam(4, $lastName, PDO::PARAM_STR);

    $query->execute();
    $query->CloseCursor();
}

function deleteUser($username, $password, $firstName, $lastName)
{
    $query = dbConnect()->prepare("CALL DELETE_USER(?,?,?,?)");

    $query->bindParam(1, $username, PDO::PARAM_STR);
    $query->bindParam(2, $password, PDO::PARAM_STR);
    $query->bindParam(3, $firstName, PDO::PARAM_STR);
    $query->bindParam(4, $lastName, PDO::PARAM_STR);

    $query->execute();
    $query->CloseCursor();
}

function slow_equals($a, $b)
{
    $diff = strlen($a) ^ strlen($b);
    for($i = 0; $i < strlen($a) && $i < strlen($b); $i++)
    {
        $diff |= ord($a[$i]) ^ ord($b[$i]);
    }
    return $diff === 0;
}

function make_thumb($src,$dest,$desired_width)
{
    /* read the source image */
    $source_image = imagecreatefromjpeg($src);
    $width = imagesx($source_image);
    $height = imagesy($source_image);
    /* find the "desired height" of this thumbnail, relative to the desired width  */
    $desired_height = floor($height*($desired_width/$width));
    /* create a new, "virtual" image */
    $virtual_image = imagecreatetruecolor($desired_width,$desired_height);
    /* copy source image at a resized size */
    imagecopyresized($virtual_image,$source_image,0,0,0,0,$desired_width,$desired_height,$width,$height);
    /* create the physical thumbnail image to its destination */
    imagejpeg($virtual_image,$dest);
}

function get_files($images_dir,$exts = array('jpg'))
{
    $files = array();
    if($handle = opendir($images_dir))
    {
        while(false !== ($file = readdir($handle)))
        {
            $extension = strtolower(get_file_extension($file));
            if($extension && in_array($extension,$exts))
            {
                $files[] = $file;
            }
        }
        closedir($handle);
    }
    return $files;
}

function get_file_extension($file_name)
{
    return substr(strrchr($file_name,'.'),1);
}

//****DisplayImage*****************************************************************************************************/
function getImages()
{
    /** settings **/
    $images_dir = '../images/';
    $thumbs_dir = '../thumbs/';
    $thumbs_width = 200;
    $images_per_row = 3;

    /** generate photo gallery **/
    $image_files = get_files($images_dir);
    if(count($image_files)) {
        foreach($image_files as $index=>$file)
        {
            ksort($image_files);
            $index++;
            $thumbnail_image = $thumbs_dir.$file;
            if(!file_exists($thumbnail_image))
            {
                $extension = get_file_extension($thumbnail_image);
                if($extension)
                {
                    make_thumb($images_dir.$file,$thumbnail_image,$thumbs_width);
                }
            }
            echo '<a href="gestimage.php?',$images_dir.$file,'" name="imageClick" class="photo-link smoothbox" rel="gallery"><img src="',$thumbnail_image,'" /></a>';
            if($index % $images_per_row == 0) { echo '<div class="clear"></div>'; }
        }
        echo '<div class="clear"></div>';
    }
    else
    {
        echo '<p>There are no images in this gallery.</p>';
    }
}
//****DisplayImage*****************************************************************************************************/

//****DisplayGestionnaireImage*****************************************************************************************/
function getGestImages($image)
{
    echo "<img src='../images/".$image['image']."' />";
}
//****DisplayGestionnaireImage*****************************************************************************************/

//****UploadImage******************************************************************************************************/
function upload_Image()
{
    $ext_type = array('gif','jpg','jpe','jpeg','png');
    $maxsize    = 2097152;

    if(isset($_POST['upload_img']))
    {
        $file_name = $_FILES['image']['name'];
        $file_type = $_FILES['image']['type'];
        $file_size = $_FILES['image']['size'];
        $file_tmp_name = $_FILES['image']['tmp_name'];

        if(move_uploaded_file($file_tmp_name, "images/$file_name") && $file_type == $ext_type && $file_size < $maxsize)
        {
            echo 'Image is uploaded !';
        }
    }
}
//****UploadImage******************************************************************************************************/

//****DeleteImage******************************************************************************************************/
function delete_Image()
{
    if(isset($_POST['delete_img']))
    {
        $img_file = $_POST['filename'];
        if($img_file)
        {
            unlink("images/$img_file");
            header("Refresh:0");
        }
    }
}
//****DeleteImage******************************************************************************************************/

//****bdCommentaire()**************************************************************************************************/
function bdCommentaire()
{
    mysql_connect("mysql host name","mysql user name","mysql password");
    mysql_select_db("database name");
    $name=$_POST['name'];
    $comment=$_POST['comment'];
    $submit=$_POST['submit'];

    $dbLink = mysql_connect("mysql host name", "mysql user name", "mysql password");
    mysql_query("SET character_set_client=utf8", $dbLink);
    mysql_query("SET character_set_connection=utf8", $dbLink);

    if($submit)
    {
        if($name&&$comment)
        {
            $insert=mysql_query("INSERT INTO comment (name,comment) VALUES ('$name','$comment') ");
            echo "<meta HTTP-EQUIV='REFRESH' content='0; url=commentindex.php'>";
        }
        else
        {
            echo "please fill out all fields";
        }
    }
}
//****bdCommentaire()**************************************************************************************************/

//****afficherbdCommantaire()******************************************************************************************/
function afficherbdCommantaire()
{
    $dbLink = mysql_connect("mysql host name", "mysql username", "mysql password");
    mysql_query("SET character_set_results=utf8", $dbLink);
    mb_language('uni');
    mb_internal_encoding('UTF-8');

    $getquery=mysql_query("SELECT * FROM comment ORDER BY id DESC");
    while($rows=mysql_fetch_assoc($getquery))
    {
        $id=$rows['id'];
        $name=$rows['name'];
        $comment=$rows['comment'];
        echo $name . '<br/>' . '<br/>' . $comment . '<br/>' . '<br/>' . '<hr size="1"/>'
        ;}
}
//****afficherbdCommantaire()******************************************************************************************/

function showHeader($string)
{
    menu();
    ?>
    <div class="wrap">
        <h1 class="header-heading"><?=$string?></h1>
    </div>
    <?php
}

function showFooter()
{
    ?>
    <div class="wrap">
        <h1 class="header-heading"> Copyright © 2015 | depotdimages.com by AL&&YD Themes </h1>
    </div>
    <?php
}
?>