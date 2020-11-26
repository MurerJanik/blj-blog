<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style2.css">
</head>
<body>
<nav class="nav">
        <ul class="ul">
        <li class="li"><a href="/blj/blog/home.php">Home</a></li>
        <li class="li"><a class="blog_button" href="/blj/blog/blog.php">Blog</a></li>
        <li class="li"><a href="/blj/blog/blj_liste.php">BLJ_Linkliste</a></li>
        </ul>
    </nav>

    <h1 class="titel">Liste:</h1>
    
<div class="list">
<?php 
$dbuser = "d041e_listuder";

// ACHTUNG: DU MUST HIER NOCH DAS PASSWORT EINSETZEN. DU FINDEST ES AUF DISCORD IM INFO CHANNEL
$dbpass = "12345_Db!!!";

$pdo = new PDO("mysql:host=mysql2.webland.ch;dbname=d041e_listuder", $dbuser, $dbpass, [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
]);


$sqlQuery = $pdo->query("SELECT * FROM `blog_url`");
$urls = $sqlQuery->fetchAll();
foreach ($urls as $url) {   
}

foreach($urls as $url) {
    $link = '<a href="' . $url["blogUrl"] . '" target="_blank">' . $url["blogAuthor"] . '\'s Blog' . '</a>' . '<br>';

   echo $link;
} 

?>
</div>



</body>
</html>