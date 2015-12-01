<?php
/**
 * Created by PhpStorm.
 * User: 201087112
 * Date: 2015-11-23
 * Time: 15:02
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
                <li><a href="../Views/create_delete_users.php">Gestion</a></li>
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
    if(isset($_SESSION[ "connected" ]))
    {
        if($_SESSION[ "connected" ])
        {
            // Redirige vers la page d'accueil.
            header('Location: ../Views/index.php');
        }
    }
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

/* function:  generates thumbnail */
function make_thumb($src,$dest,$desired_width) {
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

/* function:  returns files from dir */
function get_files($images_dir,$exts = array('jpg')) {
    $files = array();
    if($handle = opendir($images_dir)) {
        while(false !== ($file = readdir($handle))) {
            $extension = strtolower(get_file_extension($file));
            if($extension && in_array($extension,$exts)) {
                $files[] = $file;
            }
        }
        closedir($handle);
    }
    return $files;
}

/* function:  returns a file's extension */
function get_file_extension($file_name) {
    return substr(strrchr($file_name,'.'),1);
}

//DisplayImage
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
        foreach($image_files as $index=>$file) {
            $index++;
            $thumbnail_image = $thumbs_dir.$file;
            if(!file_exists($thumbnail_image)) {
                $extension = get_file_extension($thumbnail_image);
                if($extension) {
                    make_thumb($images_dir.$file,$thumbnail_image,$thumbs_width);
                }
            }
            echo '<a href="',$images_dir.$file,'" class="photo-link smoothbox" rel="gallery" onclick="showImg(this.href,800,600,\'This is Image1\'); return false"><img src="',$thumbnail_image,'"/></a>';
            if($index % $images_per_row == 0) { echo '<div class="clear"></div>'; }
        }
        echo '<div class="clear"></div>';
    }
    else {
        echo '<p>There are no images in this gallery.</p>';
    }
}

//DisplayGestionnaireImage
function getGestImages()
{
    $images_dir = '../images/';
    $image_files = get_files($images_dir);
    echo '<a href="',$images_dir,'" class="photo-link smoothbox" rel="gallery"><img src="',$image_files,'" /></a>';
}

//UploadImage
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

//DeleteImage
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

function showHeaderProfil()
{
    menu();
    ?>
    <div class="wrap">
        <h1 class="header-heading">Gestionnaire de mon Profil</h1>
    </div>
    <?php
}

function showHeader()
{
    menu();
    ?>
    <div class="wrap">
        <h1 class="header-heading">La galerie d'images</h1>
    </div>
    <?php
}

function showFooter()
{
    ?>
    <div class="wrap">
        <h1 class="header-heading"> Antoine Latendresse && Yannick Delaire </h1>
    </div>
    <?php
}
?>