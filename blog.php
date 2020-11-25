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
    <ul>
    <li><a href="/blj/blog/home.php">Home</a></li>
    <li><a class="blog_button" href="/blj/blog/blog.php">Blog</a></li>
    </ul>
</nav>


<form action="blog.php" method="post"> 
    
    <div class="name">  
        <label for="name">Name:</label>
        <textarea class="textfeld" id="name" name="name" cols="40" rows="2"></textarea> 
    </div> 

    <div class="titel">
    <label for="title">Titel:</label>
    <textarea class="textfeldtitel" name="title" id="title" cols="40" rows="2"></textarea>
    </div>

    <div class="text">
        <label for="text">Text:</label>
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
        $okToSend = true;
    }
?>

<!-- Send Posts to DB-->
<?php
if ($okToSend){
    $stmt = $pdo->prepare('INSERT INTO posts (created_by, post_title, post_text, created_at)
                                            VALUES (:created_by, :post_title, :post_text, now())');
    $stmt->execute([":created_by" => "$form[name]", ":post_title" => "$form[title]", ":post_text" => "$form[text]"]);
}
?>

<!-- Get Posts from DB -->
<?php
    $name_array = array();
    $time_array = array();
    $text_array = array();
    $title_array = array();
    $counter = 0;
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
        $counter++;
    }  
?>
<!-- DB Logic by Rouven \(￣︶￣*\)) -->

<div class="border"></div>

<!-- Print out Posts-->
<div class="posts">
<?php
    for ($i = 0;$i < $counter;$i++){
        echo " Name: $name_array[$i] <br> Zeit: $time_array[$i] <br> Titel: $title_array[$i] <br> Text: $text_array[$i] <br>"; 
    }
?>
</div>



</body>
</html>