<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>blog.php</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>


<nav class="nav">
        <ul class="ul">
        <li class="li"><a href="/blj/blog/home.php">Home</a></li>
        <li class="li"><a class="blog_button" href="/blj/blog/blog.php">Blog</a></li>
        <li class="li"><a href="/blj/blog/blj_liste.php">BLJ_Linkliste</a></li>
        </ul>
    </nav>


<form action="blog.php" method="post"> 
    
    <div class="name">  
        <label class="color"for="name">Name:</label>
        <textarea class="textfeld" id="name" name="name" cols="40" rows="2"></textarea> 
    </div> 

    <div class="titel">
    <label class="color" for="title">Titel:</label>
    <textarea class="textfeldtitel" name="title" id="title" cols="40" rows="2"></textarea>
    </div>

    <div class="text">
        <label class="color" for="text">Text:</label>
        <textarea class="textfeld2" name="text" id="text" cols="40" rows="15"></textarea>
    </div>
    <div class="submit">
        <input  type="submit" value="Senden" />
    </div>
</form> 


<?php
    try {
        $user = 'root';
        $password = '';
        $pdo = new PDO('mysql:host=localhost;dbname=posts', $user, $password, [
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
        "text"=> ""
    );


    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        foreach($form as $n => $value){
            $form[$n] = $_POST[$n] ?? "";
        }

        $stmt = $pdo->prepare('INSERT INTO posts (created_by, post_title, post_text, created_at)
                                VALUES (:created_by, :post_title, :post_text, now())');
        $stmt->execute([":created_by" => "$form[name]", ":post_title" => "$form[title]", ":post_text" => "$form[text]"]);
    }
?>

<div class="border"></div>
<div class="posts-wrapper">
    <!-- Print out Posts-->
    <div class="posts">

<!-- Get Posts from DB -->
<?php
   
    $stmt = $pdo->query('SELECT created_at, created_by, post_text, post_title  FROM `posts` ORDER BY created_at desc');
    $posts = $stmt->fetchAll();     
    foreach($posts as $post) {
        echo "<p class=\"post\"> Name: $post[1] <br> Zeit: $post[0] <br> Titel: $post[3]  <br> Text: $post[2]  <br></p> ";      
    }
    ?>
    </div>
</div>
</body>
</html>