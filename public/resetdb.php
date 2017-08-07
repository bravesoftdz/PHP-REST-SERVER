<?php

  require_once '../src/config/db.php';
  
  //-------------------------------------------------
  // pricelist table
  //-------------------------------------------------
  echo "Creating table pricelist...";
    $pdo = Database::connect();
  $qry = "DROP TABLE IF EXISTS pricelist";	
  $stmt = $pdo->prepare($qry);
  $stmt->execute();  
  $qry = 
    "CREATE TABLE pricelist ( " .
	" id INT NOT NULL AUTO_INCREMENT, " .
	" sku VARCHAR(20), " .
  " skusize VARCHAR(20), " .
  " barcode VARCHAR(25), " .
	" description VARCHAR(100), " .
  " price FLOAT(30,2), " .
  " PRIMARY KEY (id) )";
   "ENGINE = InnoDB";
	$stmt = $pdo->prepare($qry);
	$stmt->execute();
   Database::disconnect(); 

    $pdo = Database::connect();
    $qry = 
    "INSERT INTO pricelist (id, sku, skusize, barcode, description, price) VALUES
  (1, 'MEA001', '1 X 6', '3458945985078', 'Tinned Meat 200g', 145.67),
  (2, 'CAT023', '1 X 6', '6348976967485', 'Pet Edables 300g ', 102.99),
  (3, 'CAT032', '1 X 6 ', '4355665698565', 'Pet Cats Tinned Food 200g ', 302.92),
   (4, 'TAS022', '1 X 6 ', '2345569856929', 'Lead Cat Silver/Clasp ', 22.92),
    (5, 'TAS012', '1 X 6 ', '5698656985692', 'Lead Cat Black/Clasp ', 22.92),
  (6, 'DOG001', '1 X 12', '5485923902390', 'Tinned Dog Food 300g', 116.89)";
  $stmt = $pdo->prepare($qry);
  $stmt->execute();
   Database::disconnect(); 


   header("Location: view.php"); 
