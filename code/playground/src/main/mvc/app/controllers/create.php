<?php

use models\Offer;

require_once '../models/Offer.php';

// Upload image to folder
move_uploaded_file($_FILES["image"]["tmp_name"], "../view/images/" . $_FILES["image"]["name"]);

// Insert offer in database
$offer = new Offer("", $_POST['title'], $_FILES["image"]["name"], $_POST['description']);
$offer->insert();
header("Location: index.php");
