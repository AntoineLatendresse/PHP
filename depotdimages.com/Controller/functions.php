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

function getSessionVar()
{
    if (isset($_GET['image']))
    {
        $_SESSION['imageSelect'] = $_GET['image'];
    }
}

// Function to get the client ip address
function get_client_ip_env() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';

    return $ipaddress;
}

function loginManager($Username,$Date,$Ip)
{
    $Fichier = "../BD/loginManager.txt";
    $var = $Username.":".$Date."/".get_client_ip_env()."-";

    if ($handle = fopen($Fichier, 'a')) {
        fwrite($handle, $var . "\n");
    }
}

function getStringBetween($str, $from, $to)
{
    $sub = substr($str, strpos($str, $from) + strlen($from), strlen($str));
    return substr($sub, 0, strpos($sub, $to));
}

function listPastUsers()
{
    echo '
<div class="row">
    	<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  	<div class="panel-heading">';
    $handleLog = fopen('../BD/loginManager.txt', 'r');
    if($handleLog)
    {
        echo "
    <div class='well'>
    <table class='table'>
      <thead>
        <tr>
          <th>#</th>
          <th>Utilisateur</th>
          <th>Date</th>
          <th>Adresse IP</th>
        </tr>
      </thead>
      <tbody>";
        while (($lineLog = fgets($handleLog)) !== false) {
            $Array[] = $lineLog;
        }
        if (!empty($Array)) {
            $cpt = 1;
            for ($i = count($Array) - 1; $i >= count($Array) - 10 ; $i--) {
                if($i >= 0)
                {
                    $username= substr($Array[$i], 0, strpos($Array[$i], ':'));
                    $date =  getStringBetween($Array[$i], ':', '/');
                    $ipadress = getStringBetween($Array[$i], '/', '-');
                    echo "
            <tr>
              <td>$cpt</td>
              <td>$username</td>
              <td>$date</td>
              <td>$ipadress</td>
            </tr>";
                    $cpt++;
                }
            }
        }
        echo "</tbody>
</table>
</div>";
    }
    echo "        </div>
            </div>
        </div>
    </div>
</div>";
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

function getPhotos()
{
    $query = dbConnect()->prepare("CALL SELECT_PHOTOS()");

    $query->execute();
    $query->CloseCursor();
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
    if(count($image_files))
    {
        foreach($image_files as $index=>$file)
        {
            $files[$file] = filemtime("../images/$file");
            arsort($files);
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
                echo '<a href="gestimage.php?image=../images/',$file,'" name="imageClick" type="submit" class="photo-link smoothbox"><img src="',$thumbnail_image,'" /></a>';
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

//****UploadImage******************************************************************************************************/
function upload_Image()
{
    // Check if image file is a actual image or fake image
    if(isset($_POST["upload_img"]))
    {
        //$uploadOk = 1;
        $file_name = $_FILES['image']['name'];
        $file_type = pathinfo("../images/$file_name",PATHINFO_EXTENSION);
        $file_size = $_FILES['image']['size'];
        $file_tmp_name = $_FILES['image']['tmp_name'];
        $check = getimagesize($file_tmp_name);
        if($check !== false)
        {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        }
        else
        {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        // Check if file already exists
        if (file_exists("../images/$file_name"))
        {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($file_size > 10485760)
        {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($file_type != "gif" && $file_type != "jpg" && $file_type != "jpe" && $file_type != "jpeg" && $file_type != "gif")
        {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk != 0)
        {
            if (move_uploaded_file($file_tmp_name, "../images/$file_name"))
            {
                header("Refresh:0");
                echo "The file " . $file_name . " has been uploaded.";
            }
            else
            {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        else // if everything is ok, try to upload file
        {
            echo "Sorry, your file was not uploaded.";
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