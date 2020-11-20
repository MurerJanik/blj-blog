<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>blog.php</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="everything">

<div>
    <h3>Mein Blog</h3>
    
</div>


<form action="blog.php" method="post"> 
    <div class="name">  
        <label for="text">Name:</label>
        <textarea class="textfeld" id="name" name="name" cols="40" rows="2"></textarea> 
      
   </div> 

    <div class="text">
         <label for="text">Text:</label>      
         <textarea class="textfeld2" name="text" id="text" cols="40" rows="15"></textarea>
   </div>

     <input class="senden" type="submit" value="Senden" />
   
</form> 

<div class="border"> </div>


</body>
</html>