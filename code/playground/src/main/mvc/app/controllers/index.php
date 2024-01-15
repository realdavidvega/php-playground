<?php

use models\Offer;

require_once '../models/Offer.php';

  // Get all offers
  $data['offers'] = Offer::findAll();

  // Load view
  include '../views/offers.php';

