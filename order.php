<?php 
	if(isset($_POST["username"]) && isset($_POST["apples"]) && isset($_POST["oranges"]) && isset($_POST["bananas"]) && isset($_POST["payment"]) && isset($_POST["total"])) {
		$username = $_POST["username"];
		$apples = intval($_POST["apples"]);
		$bananas = intval($_POST["bananas"]);
		$oranges = intval($_POST["oranges"]);
		$total_price = $_POST["total"];
		$payment = $_POST["payment"];

		$filename = "order.txt";
		
		$filesize = filesize($filename);
		$file = fopen( $filename, "r");

		$apples_ori = 0;
		$bananas_ori = 0;
		$oranges_ori = 0;

        if($filesize == 0) {
        	$file = fopen( $filename, "w");
        	fwrite($file , "Total number of apples: $apples\nTotal number of oranges: $oranges\nTotal number of bananas: $bananas" );
        } else {
        	$filetext = fread( $file, $filesize );
        	$orders = explode("\n" , $filetext);

        	$apples_ori = intval(explode(": " , $orders[0])[1]);
        	$oranges_ori = intval(explode(": " , $orders[1])[1]);
        	$bananas_ori = intval(explode(": " , $orders[2])[1]);

        	$apple_total = $apples + $apples_ori;
        	$orange_total = $oranges + $oranges_ori;
        	$banana_total = $bananas + $bananas_ori;

        	$file = fopen( $filename, "w");
        	fwrite($file , "Total number of apples: $apple_total\nTotal number of oranges: $orange_total\nTotal number of bananas: $banana_total" );
        }

        fclose( $file );

        echo '<html>
				<head>
					<title>Order Details</title>
					<link href="css/bootstrap.min.css" rel="stylesheet">
				</head>
				<body>
				<div class="container">
					<table class="table table-borded table-striped">
			        	<tr><center><h1>Order Details<h1/></center></tr>
			        	<tr>
			        		<td>Customer: </td>
			        		<td>'.$username.'</td>
			        	</tr>
			        	<tr>
			        		<td>Apples: </td>
			        		<td>'.$apples.'</td>
			        	</tr>
			        	<tr>
			        		<td>Oranges: </td>
			        		<td>'.$oranges.'</td>
			        	</tr>
			        	<tr>
			        		<td>Bananas: </td>
			        		<td>'.$bananas.'</td>
			        	</tr>
			        	<tr>
			        		<td>Total Price: </td>
			        		<td>'.$total_price.'</td>
			        	</tr>
			        	<tr>
			        		<td>Payment Price: </td>
			        		<td>'.$payment.'</td>
			        	</tr>
			        </table>
			    </div>
			    </body>
			   </html>';

	} else {
		var_dump($_POST);

		echo "<br/>Sorry, your information is not complete!";
	}
?>