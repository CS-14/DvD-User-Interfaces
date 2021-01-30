<!DOCTYPE html>
    <html lang ="en">
<head>
    <meta charset ="UTF-8">
    <title>Photo Gallery</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<div class="container">
    <h3><a href="imageupload.php">Upload Image</a></h3>
    <div class ="gallery">
        <?php
        //reading the list of the files in the folder
        $file_list =scandir('image/');

        echo'<pre>';
        print_r($file_list);
        echo'</pre>';
        ?>

    </div>

</div><!--.container>
</body>
</html>