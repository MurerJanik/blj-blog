<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>blog</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>


    <nav class="nav">
        <ul class="ul">
        <li class="li"><a href="home.php">Home</a></li>
        <li class="li"><a class="blog_button" href="blog.php">Blog</a></li>
        <li class="li"><a href="blj_liste.php">BLJ_Linkliste</a></li>
        </ul>
    </nav>



    <form action="blog.php" method="post"> 

    <div class="name">  
        <label class="color"for="name">Name:</label>
        <textarea class="textfeld" id="name" name="name" cols="40" rows="2" ></textarea> 
    </div> 

    <div class="titel">
    <label class="color" for="title">Titel:</label>
    <textarea class="textfeldtitel" name="title" id="title" cols="40" rows="2" ></textarea>
    </div>

    <div class="text">
        <label class="color" for="text">Text:</label>
        <textarea class="textfeld2" name="text" id="text" cols="40" rows="15" ></textarea>
    </div>

    <div class="post_img">
        <label class="color" for="post_img">Url:</label>
        <textarea class="post_img" name="post_img" id="post_img" cols="40" rows="3" ></textarea>
    </div>
    <div class="submit">
        <input  type="submit" value="Senden" />
    </div>
</form> 




<?php
    try {
        $user = 'd041e_jamurer';
        $password = '12345_Db!!!';
        $pdo = new PDO('mysql:host=mysql2.webland.ch;dbname=d041e_jamurer', $user, $password, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    ]);
    }
    catch (PDOException $e) {
            die('Keine Verbindung zur Datenbank möglich: ' . $e->getMessage());
    }
?>


<!-- Take stuf of form and put it into array -->
<?php
    //no warnings
    error_reporting(E_ALL ^ E_WARNING);
    $form = array(
        "name"=> "",
        "title"=> "",
        "text"=> "",
        "post_img" => ""
    );

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        foreach($form as $n => $value){
            $form[$n] = $_POST[$n] ?? "";
        }
        $form[name]=$_POST[name];
        $stmt = $pdo->prepare('INSERT INTO posts (created_by, post_title, post_text, created_at, post_img)
                            VALUES (:created_by, :post_title, :post_text, now(), :post_img)');
        $stmt->execute([":created_by" => "$form[name]", ":post_title" => "$form[title]", ":post_text" => "$form[text]", ":post_img" => "$form[post_img]"]);
    }
?>

<div class="border"></div>
<div class="posts-wrapper">
    <!-- Print out Posts-->
    <div class="posts">

<!-- Get Posts from DB -->
<?php
    $name_array = array();
    $time_array = array();
    $text_array = array();
    $title_array = array();
    $img_array = array();
    $stmt = $pdo->query('SELECT created_by FROM `posts`');
    foreach($stmt->fetchAll() as $nr => $x) {
        $name_array[$nr] =  "$x[0]";
    }  
    $stmt = $pdo->query('SELECT created_at FROM `posts`');
    foreach($stmt->fetchAll() as $nr => $x) {
        $time_array[$nr] =  "$x[0]";
    }  
    $stmt = $pdo->query('SELECT post_text FROM `posts`');
    foreach($stmt->fetchAll() as $nr => $x) {
        $text_array[$nr] =  "$x[0]";
    }  
    $stmt = $pdo->query('SELECT post_title FROM `posts`');
    foreach($stmt->fetchAll() as $nr => $x) {
        $title_array[$nr] =  "$x[0]";
    }  
    $stmt = $pdo->query('SELECT post_img FROM `posts`');
    foreach($stmt->fetchAll() as $nr => $x) {
        $img_array[$nr] =  "$x[0]";
    }
    foreach(/* bedingung */){
        echo "<p class=\"post\"> Name: $post[1] <br> Zeit: $post[0] <br> Titel: $post[3]  <br> Text: $post[2] <br> Url: $post[4]  <br></p> ";    
    }  
    ?>
    </div>
    
</div>
</body>
</html>