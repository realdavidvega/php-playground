<?php

use models\Offer;

require_once '../models/Offer.php';
$offer = new Offer($_GET['id']);
$offer->delete();
header("Location: index.php");
