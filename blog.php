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
        <label for="text">Name:</label>
        <textarea class="textfeld" id="name" name="name" cols="40" rows="2"></textarea> 
   </div> 

   <div class="titel">
    <label for="text">Titel:</label>
    <textarea class="textfeldtitel" name="textfeld" id="titel" cols="40" rows="2"></textarea>
   </div>

    <div class="text">
         <label for="text">Text:</label>
         <textarea class="textfeld2" name="text" id="text" cols="40" rows="15"></textarea>
   </div>
    <div class="submit">
        <input  type="submit" value="Senden" />
    </div>
</form> 

<div class="border"> 
    
</div>


</body>
</html>