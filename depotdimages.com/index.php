<?php
/**
 * Created by Latendresse Antoine && Yannick Delaire.
 * Date: 11/16/15
 */
$count = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    foreach ($_FILES['files']['name'] as $i => $name)
    {
        if (strlen($_FILES['files']['name'][$i]) > 1)
        {
            if (move_uploaded_file($_FILES['files']['tmp_name'][$i], 'upload/'.$name))
            {
                $count++;
            }
        }
    }
}
?>
<?php
// exemple avec le répertoire courant
$repertoire = "upload/";

// la valeur de retour de scandir est un tableau
$fichiers = scandir($repertoire);

// si le répertoire est valide
if ($fichiers !== FALSE) {
    // on parcourt le tableau
    for ($i = 0; $i < sizeof($fichiers); $i++) {
        $nomFichier = $fichiers[$i];
        // on évite l'affichage des fichiers cachés
        if ($nomFichier[0] != ".") {
            echo $nomFichier . "<br>";
        }
    }
} else {
    die("Erreur: repertoire invalide");
};
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>All your photos organized and easy to find</title>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        a{
            text-decoration: none;
            color: #333;
        }
        body {
            text-align:center;
            background-color:#8BC34A;
            font-family:Arial, Helvetica, sans-serif;
            font-size:80%;
            color:#666;
        }
        .wrap {
            background: #f3f8fb;
            width:730px;
            margin:30px auto;
            border: 4px dashed #8BC34A;
            border-radius:4px;
            padding: 20px 5px;
        }
        h1 {
            font-family:Georgia, "Times New Roman", Times, serif;
            font-size:170%;
            color:#645348;
            font-style:italic;
            text-decoration:none;
            font-weight:100;
            padding: 10px;
        }
        .button {
            border-radius: 10px;
            background-color: #8BC34A;
            border: 0;
            color: #fff;
            font-weight: bold;
            font-style: italic;
            padding: 11px 20px 10px;
            cursor: pointer;
        }
        input[type="file"]{
            color: transparent;
        }
        input[type="submit"]:hover,:focus{
            background-position:100px;
        }
        .msg{
            background: #ddeff8;
            padding: 5px;
            margin-bottom: 15px;
            border: #8BC34A dotted 1px;
        }
        .copy{
            margin-top: 20px;
            clear: both;
        }
    </style>
</head>

<body>
<div class="wrap">
    <?php
    if ($count > 0) {
        echo "<p class='msg'>{$count} files uploaded</p>\n\n";
    }
    ?>
    <h1>Upload your photos: <h1>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="files[]" id="files" multiple="" directory="" webkitdirectory="" mozdirectory="">
        <input class="button" type="submit" value="Upload" />
    </form>
</div>
</body>
</html>