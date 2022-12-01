<?php

//fetch_data.php

include 'components/connect.php';

if(isset($_POST["action"]))
{
	$query = "
		SELECT * FROM products WHERE product_status = '0'
	";
	if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
	{
		$query .= "
		 AND price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
		";
	}
	if(isset($_POST["category"]))
	{
		$category_filter = implode("','", $_POST["category"]);
		$query .= "
		 AND category IN('".$category_filter."')
		";
	}

	$statement = $conn->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_row = $statement->rowCount();
	$output = '';
	if($total_row > 0)
	{
		foreach($result as $row)
		{
			$output .= '
			<div class="col-sm-6 col-md-4 col-lg-3">
			<div class="card mt-5 text-center" >
			       <img src="uploaded_img/'. $row['image'] .'" alt="" class="card-img-top" >
				   <div class="card-body">
                   <h5 class="card-title">'. $row['name'] .'</h5>
				   <h5 class="card-subtitle mb-2 text-muted">'. $row['category'] .'</h5>
				   <h3 class="card-text">'. $row['price'] .' R$</h3>
				   <a href="detalhes.php?pid='. $row['id'] .'" class="btn-success btn-lg">Detalhes</a>
				</div>
				</div>
			</div>
			';
		}
	}
	else
	{
		$output = '<h3 id="txtcentral">Livros não encontrados</h3>';
	}
	echo $output;
}

?>