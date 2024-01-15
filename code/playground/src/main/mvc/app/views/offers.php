<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Offers</title>
  </head>
  <body>
  <h1>Pizzeria</h1>
  <a href="../controllers/create.php">New offer</a>
  <hr>
  <?php
    foreach($data['offers'] as $offer)  {
    ?>
      <h3><?=$offer->getTitulo()?></h3>
      <img src="../views/images/<?=$oferta->getImagen()?>" width="400"><br>
      <p><?=$offer->getDescripcion()?></p><br>
      <a href="../controllers/delete.php?id=<?=$offer->getId()?>">Delete</a>
    <?php
    }
  ?>
  </body>
</html>
