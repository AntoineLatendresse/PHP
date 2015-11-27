<?php
/**
 * Created by PhpStorm.
 * User: 201087112
 * Date: 2015-11-23
 * Time: 15:02
 */

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
    </ul>
    </div>
    <?php
}

function updateProfil($username, $newPassword, $newPasswordConfirm, $firstName, $lastName)
{
    $query = dbConnect()->prepare("CALL UPDATE_PROFIL(?,?,?,?,?)");

    $query->bindParam(1, $username, PDO::PARAM_STR);
    $query->bindParam(2, $newPassword, PDO::PARAM_STR);
    $query->bindParam(3, $newPasswordConfirm, PDO::PARAM_STR);
    $query->bindParam(4, $firstName, PDO::PARAM_STR);
    $query->bindParam(5, $lastName, PDO::PARAM_STR);

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