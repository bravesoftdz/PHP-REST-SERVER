<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="../dist/css/bootstrap.min.css" rel="stylesheet">
      <script src="../dist/js/bootstrap.min.js"></script>
	              <script src="../dist/js/jquery.js"></script>
   
</head>

<body>
    <div class="container">
    		<div class="row">
    		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
    			<h3>Rest Slim Demo<small> Bayesean Blog - localhost will depend on your local setup</small><span style="float:right"><a href="resetdb.php"  class="btn btn-success">Reset Database</a></span></h3>
								<!--	<br>-->

<div class="panel panel-default"> 
<div class="panel-body">
<p><strong> API Calls - </strong><em> <strong>&nbsp;&nbsp; id </strong>(integer)  row no of the database table </em> </p>
<p><strong> Get All  </strong> <em>'localhost/public/api/pricing/'</em> </p>
<p><strong> Get One</strong><em>  'localhost/public/api/pricing/<strong>id</strong>'</em> </p>
<p><strong> Put One </strong><em> 'localhost/public/api/pricing/update/<strong>id</strong>'</em> </p>
<p> <strong>Post </strong><em> 'localhost/public/api/pricing/add'</em> </p>
<p> <strong>Delete </strong><em>'localhost/public/api/pricing/delete/<strong>id</strong>'</em> 
</p>
<p> <strong>Delete All </strong><em>'localhost/public/api/pricing/delete/<strong>0</strong>'</em></p>
</div>
</div>
    		
			<h4>Sales Price List </h4>
						<table class="table table-striped">
		              <thead>
		                <tr>
		                  <th>No</th>
		                  <th>sku</th>
		                  <th>skusize</th>
		                  <th>barcode</th>
		                  <th>description</th>
		                  <th>price</th>
		                 <!-- <th>Process Buttons</th>-->
		                </tr>
		              </thead>
		              <tbody>
		              <?php 
					   require '../src/config/db.php';
				      	$pdo = Database::connect();
					   $sql = 'SELECT * FROM pricelist ORDER BY id ASC';
	 				   foreach (  $pdo->query($sql) as $row) {
						   		echo '<tr>';
							    echo '<td>'. $row['id'] . '</td>';
							   	echo '<td>'. $row['sku'] . '</td>';
							   	echo '<td>'. $row['skusize'] . '</td>';
							   	echo '<td>'. $row['barcode'] . '</td>';
							  	echo '<td>'. $row['description'] . '</td>';
                            	echo '<td>'. $row['price'] . '</td>';
						  	echo '</tr>';
					   }
					   	
					   	Database::disconnect();	
					   				  ?>
				      </tbody>
	            </table>
	           
	           
    	</div>
    	</div>
    	</div>
    	

    </div> <!-- /container -->
  </body>
</html>