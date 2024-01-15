<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title></title>
  </head>
  <body>
    <form action="../controllers/create.php" enctype="multipart/form-data" method="POST">
      <h3>Title</h3>
      <input type="text" size="40" name="title">
      <h3>Image</h3>
      <input type="file" id="image" name="image">
      <br><h3>Description</h3>
      <textarea name="description" cols="60" rows="6">
      </textarea><hr>
      <input type="submit" value="Accept">
    </form>
  </body>
</html>
