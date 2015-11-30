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
    ?>
    <div id='cssmenu'>
        <ul>
            <li class='active'><a href="../Views/login.php">Login</a></li>
            <li><a href="../Views/index.php">Gallery</a></li>
            <li><a href="../Views/profil.php">Profil</a></li>
            <li><?php if (isset($_SESSION['username'])) echo "Welcome:", $_SESSION['username']; ?> </li>
            <a href="<?php echo LOGIN?>">
            <input  type="submit" value="Se connecter..." class="button" />
            </a>
            <a href="<?php echo PROFIL?>">
            <input  type="submit" value="Modifier..." class="button" />
            </a>
            <a href="<?php echo LOGOUT?>">
            <input  type="submit" value="Se deconnecter..." class="button" />
            </a>
        </ul>
    </div>
    <?php
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

function slow_equals($a, $b)
{
    $diff = strlen($a) ^ strlen($b);
    for($i = 0; $i < strlen($a) && $i < strlen($b); $i++)
    {
        $diff |= ord($a[$i]) ^ ord($b[$i]);
    }
    return $diff === 0;
}

//DisplayImage
function show_Images()
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
//UploadImage
function upload_Image()
{
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
