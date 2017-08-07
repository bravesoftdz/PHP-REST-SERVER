<?php
include '../src/config/db.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});


//Get All Products and Prices
$app->get('/api/pricing', function (Request $request, Response $response) {
  	$sql = "SELECT * FROM pricelist";
  		try{
  
  		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$stmt = $pdo->query($sql);
		$pricing = $stmt->fetchAll(PDO::FETCH_OBJ);
		Database::disconnect();
		echo json_encode($pricing);

} catch(PDOException $e){
	echo '{"error": {"text": '.$e->getMessage().'}';
}
});

//Get single Product Priced unit
$app->get('/api/pricing/{id}', function (Request $request, Response $response) {

$id = $request->getAttribute('id');

  	$sql = "SELECT * FROM pricelist where id = $id";
  		try{
    	$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$stmt = $pdo->query($sql);
		$pricing = $stmt->fetchAll(PDO::FETCH_OBJ);
		Database::disconnect();
		echo json_encode($pricing);
} catch(PDOException $e){
	echo '{"error": {"text": '.$e->getMessage().'}';
}
});

// Add Product and Pricing single field
$app->post('/api/pricing/add', function(Request $request, Response $response){

    $sku = $request->getParam('sku');
    $skusize = $request->getParam('skusize');
    $barcode = $request->getParam('barcode');
    $description = $request->getParam('description');
    $price = $request->getParam('price');

	$sql = "INSERT INTO pricelist (sku,skusize,barcode,description,price)
	 values(:sku ,:skusize, :barcode, :description, :price)";

    try{
        $pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':sku', $sku);
        $stmt->bindParam(':skusize',  $skusize);
        $stmt->bindParam(':barcode',      $barcode);
        $stmt->bindParam(':description',      $description);
        $stmt->bindParam(':price',    $price);

        $stmt->execute();
		Database::disconnect();
        echo '{"notice": "Single Product and Pricing Added"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
}
});


// Add Product and Pricing many fields
$app->post('/api/pricing/add/all', function(Request $request, Response $response){
$data = '['.$request->getBody().']';
$data=json_decode($data,true);
try{
  /*

  // Single insert call - will not work 
 $pdo = Database::connect();
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "INSERT INTO pricelist (sku,skusize,barcode,description,price) VALUES";
$inserts = [];
$values = [];
$idx = 0;
foreach ($data as $names) {
    $idx++;
    $inserts[] = "(:sku{$idx}, :skusize{$idx}, :barcode{$idx}, :description{$idx}, :price{$idx})";
    $values[":sku{$idx}"] = $names->sku;
    $values[":skusize{$idx}"] = $names->skusize;
    $values[":barcode{$idx}"] = $names->barcode;
    $values[":description{$idx}"] = $names->description;
    $values[":price{$idx}"] = $names->price;
   
}
$sql .= implode(",", $inserts);
$sql .= " ON DUPLICATE KEY UPDATE sku = VALUES(sku), skusize = VALUES(skusize), barcode = VALUES(barcode), description = VALUES(description), price = VALUES(price)";

$query = $db->prepare($sql)->execute($values);

Database::disconnect();
        echo '{"notice": "All Products and Pricing Added "}';



//single insert method - will not work
    $pdo = Database::connect();
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
$sql = "INSERT INTO pricelist (sku,skusize,barcode,description,price) VALUES";
$subValue  = array_fill(0,count($data),"(?,?,?,?,?)");
$query.= implode(",",$subValue);
$stmt = $pdo->prepare($query);
$i=1;
//bind all values at once
foreach($data as $item){
    $stmt->bindValue($i++,      $item['sku']);
        $stmt->bindValue($i++,  $item['skusize']);
       $stmt->bindValue($i++,   $item['barcode']);
        $stmt->bindValue($i++,  $item['description']);
        $stmt->bindValue($i++,  $item['price']);
}

$stmt->execute();
 Database::disconnect();
        echo '{"notice": "All Products and Pricing Added "}';
*/
//This is a slow method of update as each row is updated one at a time. Should Update once only
       $pdo = Database::connect();
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $sql = "INSERT INTO pricelist (sku,skusize,barcode,description,price)
       values(:sku ,:skusize, :barcode, :description, :price)";
       $stmt = $pdo->prepare($sql);

  foreach ($data as $data){

       $stmt->bindValue(':sku',        $data['sku']);
        $stmt->bindValue(':skusize',    $data['skusize']);
       $stmt->bindValue(':barcode',    $data['barcode']);
        $stmt->bindValue(':description',$data['description']);
        $stmt->bindValue(':price',      $data['price']);
         $stmt->execute();
     }
        Database::disconnect();
        echo '{"notice": "All Products and Pricing Added "}';
  
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
}
});


// Update Pricing (Put)
$app->put('/api/pricing/update/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $sku = $request->getParam('sku');
    $skusize = $request->getParam('skusize');
    $barcode = $request->getParam('barcode');
    $description = $request->getParam('description');
    $price = $request->getParam('price');

    $sql = "UPDATE pricelist SET
				sku 	= :sku,
				skusize 	= :skusize,
                barcode		= :barcode,
                description		= :description,
                price 	= :price
			WHERE id = $id";

    try{
        // Get DB Object
        $pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':sku',        $sku);
        $stmt->bindParam(':skusize',    $skusize);
        $stmt->bindParam(':barcode',    $barcode);
        $stmt->bindParam(':description',$description);
        $stmt->bindParam(':price',      $price);

        $stmt->execute();
        Database::disconnect();
        echo '{"notice": {"text": "Product and Price Updated"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
/*
//replaced
// Delete price(product)
$app->delete('/api/pricing/delete/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    $sql = "DELETE FROM pricelist WHERE id = $id";

    	try{

  		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$stmt = $pdo->prepare($sql);
        $stmt->execute();
      Database::disconnect();
        echo '{"notice": {"text": "Product and Price Deleted"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
*/

// Delete price(product)
$app->delete('/api/pricing/delete/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

   if ($id==0){
    $sql = "TRUNCATE TABLE pricelist "; 
      }else{
   $sql = "DELETE FROM pricelist WHERE id = $id";   
   }
   try{
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
      Database::disconnect();
       if ($id==0){
         echo '{"notice": "All Product and Prices Deleted"}';
       }else{
        echo '{"notice": "Product and Price Deleted"}';
       }
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});




 ?>