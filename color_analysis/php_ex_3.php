<!--Takes an image and returns the top 3 colors dominant in that image-->

<!DOCTYPE html>
<html>
<head>
    <title>Image Color Analyzer</title>
</head>
<body>
<form action="process.php" method="post" enctype="multipart/form-data">
    <input type="file" name="image" accept="image/*">
    <input type="submit" value="Upload Image">
</form>
</body>
</html>