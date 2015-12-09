<?php
/**
 * Created by Latendresse Antoine && Yannick Delaire.
 * Date: 11/16/15
 */
define("LOGOUT", "../Controller/controller_logout.php");
define("LOGIN", "../Controller/controller_login.php");
define("PROFIL", "../Views/profil.php");
define("GESTIM", "../Views/gestimage.php");

//****GetSessionVar****************************************************************************************************/
function getSessionVar()
{
    if (isset($_GET['image'])) {
        $_SESSION['imageSelect'] = $_GET['image'];
    }
}
//****GetSessionVar****************************************************************************************************/

//****ShowHeader*******************************************************************************************************/
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
        <h1 class="header-heading"> Copyright © 2016 | depotdimages.com by Antoine L. && Yannick D. </h1>
    </div>
    <?php
}
//****ShowHeader*******************************************************************************************************/

//****MENU*************************************************************************************************************/
function menu()
{
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
            <?php  if(isset($_SESSION['username']) && $_SESSION['username'] == 'Admin')
            {
                ?>
                <li><a href="../Views/admin.php">Gestion</a></li>
                <?php
            }
            ?>
            <a> |||   Depot d'images   |||</a>
            <?php if (isset($_SESSION['username'])) echo "<a> Welcome: ", $_SESSION['username'], "</a>"; ?>
        </ul>
    </div>
    <?php
}
//****MENU*************************************************************************************************************/

//****BDCONNECT********************************************************************************************************/
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
//****BDCONNECT********************************************************************************************************/

//****BD***************************************************************************************************************/
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
    if(!isset($_SESSION['connected']) && $_SESSION['connected'] != '') {
        header('Location: http://' . $_SERVER['HTTP_HOST'] . 'depotdimages.com/Views/login.php');
        exit;
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
//****BD***************************************************************************************************************/

//****LoginManager*****************************************************************************************************/
// Function to get the client ip address
function get_client_ip_env() {
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

function loginManager($Username,$Date)
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
    $handleLog = fopen('../BD/loginManager.txt', 'r');
    if($handleLog)
    {
        echo "
    <table class='table'>
      <thead>
        <tr>
          <th>Numero</th>
          <th>Username</th>
          <th>Date</th>
          <th>Adresse IP</th>
        </tr>
      </thead>
      <tbody>";
        while (($lineLog = fgets($handleLog)) !== false) {
            $Array[] = $lineLog;
        }
        if (!empty($Array)) {
            $number = 1;
            for ($i = count($Array) - 1; $i >= count($Array) - 10 ; $i--) {
                if($i >= 0)
                {
                    $username = substr($Array[$i], 0, strpos($Array[$i],':'));
                    $date =  getStringBetween($Array[$i],'[',']');
                    $ipadress = getStringBetween($Array[$i],']/','-');
                    echo "
            <tr>
              <td>$number</td>
              <td>$username</td>
              <td>$date</td>
              <td>$ipadress</td>
            </tr>";
                    $number++;
                }
            }
        }
        echo "</tbody>
</table>";
    }
}
//****LoginManager*****************************************************************************************************/

//****Thumbnail********************************************************************************************************/
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

function get_file_extension($file_name)
{
    return substr(strrchr($file_name,'.'),1);
}
//****Thumbnail********************************************************************************************************/

//****DisplayImage*****************************************************************************************************/
function getImages()
{
    /** settings **/
    $images_dir = '../images/';
    $thumbs_dir = '../thumbs/';
    $thumbs_width = 200;
    $images_per_row = 3;
    $array = Sort_Directory_Files_By_Last_Modified($images_dir);
    $info = $array[0];

    /** generate photo gallery **/
    $image_files = get_files($images_dir);
    if(count($image_files)) {
        foreach($image_files as $index=>$file) {
            $thumbnail_image = $thumbs_dir.$file;
            if(!file_exists($thumbnail_image)) {
                $extension = get_file_extension($thumbnail_image);
                if($extension) {
                    make_thumb($images_dir.$file,$thumbnail_image,$thumbs_width);
                }
            }
        }
    }
    $result = count($info);
    foreach($info as $key => $detail)
    {
        $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $detail['file']);
        $out = strlen($withoutExt) > 20 ? substr($withoutExt,0,20)."..." : $withoutExt;
        echo '<a href="gestimage.php?image=../images/',$detail['file'],'" name="imageClick" type="submit" class="photo-link smoothbox"><img src="',$thumbs_dir,$detail['file'],'" />
                    <div>
                        <small><b style="font-size:18px ">',$out,'</b></small><br>
                        <small><b style="font-size:18px "> - - - - - - - - - - - - - - - - </b></small><br>
                        <small>', 'Propriétaire: ',getOwner($detail['file']),'</small><br>
                        <small>','Date: ',$detail['date'],'</small><br>
                        <small>','Commentaire: ',getNbCommentaire($detail['file']),'</small>
                     </div>
                   </a>';
        if($result % 3 == 0)
        {
            if($key % $images_per_row == 0) { echo '<div class="clear"></div>'; }
        }
        elseif($result % 3 == 1)
        {
            if($key % $images_per_row == 1) { echo '<div class="clear"></div>'; }
        }
        elseif($result % 3 == 2)
        {
            if($key % $images_per_row == 2) {echo '<div class="clear"></div>';}
        }
    }
    echo '<div class="clear"></div>';
}
//****DisplayImage*****************************************************************************************************/

//****getOwner*********************************************************************************************************/
function getOwner($fileName)
{
    $handle = fopen("../BD/photoManager.txt", 'r');
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            $Array[] = $line;
        }
        fclose($handle);
    }
    if (!empty($Array)) {
        for ($i = count($Array) - 1; $i >= 0; $i--) {
            if ($Array[$i] != "") {
                $line = $Array[$i];
                $User = substr($line, 0, strpos($line, '/'));
                $Titre = getStringBetween($line, '/', '~');
                if($Titre == $fileName){
                    return $User;
                }
            }
        }
    }
    return null;
}
//****getOwner*********************************************************************************************************/

//****getNbCommentaire*************************************************************************************************/
function getNbCommentaire($fileName)
{
    $handle = fopen("../BD/photoManager.txt", 'r');
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            $Array[] = $line;
        }
        fclose($handle);
    }
    if (!empty($Array)) {
        for ($i = count($Array) - 1; $i >= 0; $i--) {
            if ($Array[$i] != "") {
                $line = $Array[$i];
                $Titre = getStringBetween($line, '/', '~');
                $Guid = getStringBetween($line, '_', '¯');
                $NbCommentaire = 0;
                if ($Commentaire = file_get_contents("../BD/commentManager.txt")) {
                    $NbCommentaire = substr_count($Commentaire, $Guid);
                }
                if($Titre == $fileName) {
                    return $NbCommentaire;
                }
            }
        }
    }
    return null;
}
//****getNbCommentaire*************************************************************************************************/

//****SortDirectory****************************************************************************************************/
function Sort_Directory_Files_By_Last_Modified($dir, $sort_type = 'descending', $date_format = "F d Y H:i:s.")
{
    $files = scandir($dir);
    $array = array();
    foreach($files as $file) {
        if($file != '.' && $file != '..') {
            $now = time();
            $last_modified = filemtime($dir.$file);
            $time_passed_array = array();
            $diff = $now - $last_modified;
            $days = floor($diff / (3600 * 24));
            if($days) {
                $time_passed_array['days'] = $days;
            }
            $diff = $diff - ($days * 3600 * 24);
            $hours = floor($diff / 3600);
            if($hours) {
                $time_passed_array['hours'] = $hours;
            }
            $diff = $diff - (3600 * $hours);
            $minutes = floor($diff / 60);
            if($minutes) {
                $time_passed_array['minutes'] = $minutes;
            }
            $seconds = $diff - ($minutes * 60);
            $time_passed_array['seconds'] = $seconds;
            $array[] = array('file'         => $file,
                'timestamp'    => $last_modified,
                'date'         => date ($date_format, $last_modified),
                'time_passed'  => $time_passed_array);
        }
    }
    usort($array, create_function('$a, $b', 'return strcmp($a["timestamp"], $b["timestamp"]);'));
    if($sort_type == 'descending') {
        krsort($array);
    }
    return array($array, $sort_type);
}
//****SortDirectory****************************************************************************************************/

//****UploadImage******************************************************************************************************/
function upload_Image()
{
    // Check if image file is a actual image or fake image
    if(isset($_POST["upload_img"])) {
        //$uploadOk = 1;
        $file_name = $_FILES['image']['name'];
        $file_type = pathinfo("../images/$file_name",PATHINFO_EXTENSION);
        $file_size = $_FILES['image']['size'];
        $file_tmp_name = $_FILES['image']['tmp_name'];
        $check = getimagesize($file_tmp_name);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        }
        else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        // Check if file already exists
        if (file_exists("../images/$file_name")) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($file_size > 10485760) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($file_type != "gif" && $file_type != "jpg" && $file_type != "jpe" && $file_type != "jpeg" && $file_type != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk != 0) {

            if (move_uploaded_file($file_tmp_name, "../images/$file_name")) {
                //Rajouter Au fichier Text
                date_default_timezone_set("America/Montreal");
                if($Handle = fopen("../BD/photoManager.txt",'a'))
                {
                    fwrite($Handle,$_SESSION['username']. "/" . $_POST['upload_img'] . "~" . date('j M Y, G:i:s') . "_" . $_POST['upload_img'] . "¯" . "\n" );
                }
                header("Refresh:0");
                echo "The file " . $file_name . " has been uploaded.";
            }
            else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        else{ // if everything is ok, try to upload file
            echo "Sorry, your file was not uploaded.";
        }
    }
}
//****UploadImage******************************************************************************************************/

//****EnvoyerComment***************************************************************************************************/
if (isset($_POST['CommentaireEnvoyer'])) {
    $Fichier = "../BD/commentManager.txt";
    if ($_POST['comment'] != "") {
        if ($Handle = fopen($Fichier, 'a')) {
            session_start();
            fwrite($Handle, "*" . $_SESSION['username'] . "_" . $_POST['comment'] . "/" . date('j M Y, G:i:s') . "¯" . "~" . $_SESSION['imageSelect'] . "\n");
            header('Location: ../Views/gestimage.php?image='. $_SESSION['imageSelect'] );
        }
    }
}
//****EnvoyerComment***************************************************************************************************/

//****CommentManager***************************************************************************************************/
function CommentManager() //A Qui commentaire photo
{
    $handle = fopen("../BD/commentManager.txt", "r");
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            if (strpos($line, $_SESSION['imageSelect']) !== false) {
                $Array[] = getStringBetween($line, "*", "~");
            }
        }
        fclose($handle);
    }
    if (!empty($Array)) {
        for ($i = count($Array) - 1; $i >= 0; $i--) {
            $user = substr($Array[$i], 0, strpos($Array[$i], '_'));
            $comment = getStringBetween($Array[$i], "_", "/");
            $date = getStringBetween($Array[$i], "/", "¯");
            echo "
                <hr>
                <ul class=\"inputText\">
                    <strong>$user</strong>
                    <small>
                    <span></span>$date</small>
                    </br>
                    <li>$comment</li>
                    </br>
                </ul>
            ";
        }
    }
}
//****CommentManager***************************************************************************************************/

//****SupprimerImage***************************************************************************************************/
if (isset($_POST['SupprimerImage'])) {
    //Session Start
    session_start();

    //Folder Settings
    $images_dir = $_SESSION['imageSelect'];
    $thumbs_dir = '../thumbs/';
    $string = $_SESSION['imageSelect'];
    $newString = substr($string, 10);

    //Unlink
    unlink($_SESSION['imageSelect']);
    unlink($thumbs_dir . $newString);

    // + Fichier photoManager Erase
    $photoText = "../BD/photoManager.txt";
    $commentText = "../BD/commentManager.txt";
    if ($phototxt = file_get_contents($photoText)) {
        $phototxt = str_replace($newString, "", $phototxt);

        file_put_contents($photoText, $phototxt);
    }
    // + Fichier commentManager Erase
    if ($commenttxt = file_get_contents($commentText)) {
        $commenttxt = str_replace($newString, "", $commenttxt);

        file_put_contents($commentText, $commenttxt);
    }
    header('Location: ../Views/index.php');
}
//****SupprimerImage***************************************************************************************************/

//****PhotoManager*****************************************************************************************************/
function PhotoManager() //A Qui l'image
{
    $Array = array();
    $Proprétaire = "rien-";
    $Fichier = "../BD/photoManager.txt";
    if ($PHOTO = file_get_contents($Fichier)) {
        $handle = fopen("../BD/photoManager.txt", 'r');
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $Array[] = $line;
            }
            fclose($handle);
        }
    }
    $findWho = false;
    for ($i = 0; $i < count($Array) && !$findWho; $i++) {
        if (!$findWho && $_SESSION['connected'] == substr($Array[$i], 0, strpos($Array[$i], '/')) &&  $_SESSION['imageSelect'] == "../images/".getStringBetween($Array[$i], '_', '¯')) {
            $Proprétaire = substr($Array[$i], 0, strpos($Array[$i], '/'));
            $findWho = true;
        }
    }
    return $Proprétaire;
}
//****PhotoManager*****************************************************************************************************/
?>