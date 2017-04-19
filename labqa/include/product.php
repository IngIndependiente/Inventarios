<?php
/* ----------------------------------------------
	ADD PRODUCT
---------------------------------------------- */
function add_product($code, $name, $purchase_price, $sale_price, $product_type, $supplier, $email, $phone, $stock,$date_expire,$over_stock)
{
	global $database;
	$code			=	safety_filter($code);
	$name			=	safety_filter($name);
	$purchase_price		=	safety_filter($purchase_price);
	$sale_price		=	safety_filter($sale_price);
	$product_type		=	safety_filter($product_type);
	$supplier		=	safety_filter($supplier);
	$email			=	safety_filter($email);
	$phone			=	safety_filter($phone);
	$stock 			= 	safety_filter($stock);
	$date_expire 		= 	safety_filter($date_expire);
	$over_stock 		= 	safety_filter($over_stock);

	if(!is_money_format($purchase_price))	{	alert_box('alert', get_lang('Price not available')); return false;	}
	if(!is_money_format($sale_price))		{	alert_box('alert', get_lang('Price not available')); return false;	}
	
	mysql_query("INSERT INTO $database->products 
	(status, code, name, purchase_price, sale_price, product_type, supplier, email, phone, stock, date_expire,over_stock)
	VALUES
	('publish', '$code', '$name', '$purchase_price', '$sale_price', '$product_type', '$supplier', '$email', '$phone', '$stock', '$date_expire','$over_stock')
	");
	if(mysql_affected_rows() > 0)
	{
		return mysql_insert_id();
	}
	else
	{
		return false;	
	}
}
/* ----------------------------------------------
	Obtener nombre
---------------------------------------------- */

function getNombre($product_id){

$query = "SELECT name FROM product WHERE id = '$product_id';";
$result = mysql_query($query);
$name = mysql_fetch_array($result);



return $name['name'];
}

$query = "SELECT name FROM product WHERE id";

/* ----------------------------------------------
	Fin nombre
---------------------------------------------- */

/* ----------------------------------------------
	UPDATE PRODUCT
---------------------------------------------- */
function update_product($id, $status, $code, $name, $purchase_price, $sale_price, $product_type, $supplier, $email, $phone, $stock, $date_expire, $over_stock)
{
	global $database;
	$id				=	safety_filter($id);
	$status			=	safety_filter($status);
	$code			=	safety_filter($code);
	$name			=	safety_filter($name);
	$purchase_price	=	safety_filter($purchase_price);
	$sale_price		=	safety_filter($sale_price);
	$product_type	=	safety_filter($product_type);
	$supplier		=	safety_filter($supplier);
	$email			=	safety_filter($email);
	$phone			=	safety_filter($phone);
	$stock		    =   safety_filter($stock);
	$date_expire 	= 	safety_filter($date_expire);
	$over_stock		=  	safety_filter($over_stock);
	
	if(!is_money_format($purchase_price))	{	alert_box('alert', get_lang('Price not available')); return false;	}
	if(!is_money_format($sale_price))		{	alert_box('alert', get_lang('Price not available')); return false;	}
	
	$update = mysql_query("UPDATE $database->products SET
	status='$status', 
	code='$code', 
	name='$name',
	purchase_price='$purchase_price', 
	sale_price='$sale_price',
	product_type = '$product_type',
	supplier = '$supplier',
	email = '$email',
	phone = '$phone',
	stock = '$stock',
	date_expire = '$date_expire',
	over_stock = '$over_stock'
	WHERE
	id='$id'
	");
	if(mysql_affected_rows() > 0)
	{
		return true;
	}
	else
	{
		if($update == true)
		{	
			return true;
		}
		else
		{
			echo mysql_error();
			return false;	
		}
	}
}


/* ----------------------------------------------
	GET THE PRODUCT
---------------------------------------------- */
if(isset($_GET['product_id']) or isset($_POST['product_id']))
{
	if(isset($_GET['product_id'])) 			{	$product_id = safety_filter($_GET['product_id']);		}
	else if(isset($_POST['product_id'])) 	{	$product_id = safety_filter($_POST['product_id']);		}	
	
	$query_product	=	mysql_query("SELECT * FROM $database->products WHERE id='$product_id'");
	while($list_product	=	mysql_fetch_assoc($query_product))
	{
		$product['id']				=	$list_product['id'];	
		$product['status']			=	$list_product['status'];	
		$product['code']			=	$list_product['code'];	
		$product['name']			=	$list_product['name'];	
		$product['purchase_price']		=	$list_product['purchase_price'];	
		$product['sale_price']			=	$list_product['sale_price'];
		$product['product_type']		=   	$list_product['product_type'];
		$product['supplier']			=	$list_product['supplier'];
		$product['email']			=	$list_product['email'];
		$product['phone']			=	$list_product['phone'];
		$product['stock']			= 	$list_product['stock'];
		$product['date_expire']			=  	$list_product['date_expire'];
		$product['over_stock']			=	$list_product['over_stock'];

	}
	
	function get_the_product($value)
	{
		global $product;
		return $product[$value];	
	}
	
	function the_product($value)
	{
		echo get_the_product($value);	
	}
}



/* ----------------------------------------------
	GET PRODUCT
---------------------------------------------- */
function get_product($product_id, $value)
{
	global $database;
	$query_product	=	mysql_query("SELECT * FROM $database->products WHERE id='$product_id'");
	while($list_product	=	mysql_fetch_assoc($query_product))
	{
		$product['id']				=	$list_product['id'];	
		$product['status']			=	$list_product['status'];	
		$product['code']			=	$list_product['code'];	
		$product['name']			=	$list_product['name'];	
		$product['purchase_price']	=	$list_product['purchase_price'];	
		$product['sale_price']		=	$list_product['sale_price'];
		$product['product_type']	=   $list_product['product_type'];
		$product['supplier']		=	$list_product['supplier'];
		$product['email']			=	$list_product['email'];
		$product['phone']			=	$list_product['phone'];
		$product['stock']			= 	$list_product['stock'];
		$product['date_expire']		= 	$list_product('date_expire');
	}
	
	return $product[$value];	
}

function product($product_id, $value)
{
	echo get_product($product_id, $value);
}



/* ----------------------------------------------
	PRODUCT BOX
---------------------------------------------- */
function box_product_list($product_id, $product_code)
{
	global $database;
	$array_product = array();
	
	echo '<div id="box_product_list" class="reveal-modal expand">
	<table class="dataTable">
	<thead>
    	<tr>
     
    	
        	<th></th>
            <th>'.get_lang("Código").'</th>
            <th>'.get_lang("Nombre").'</th>
             <th>'.get_lang("Amount").'</th>
        </tr>
      </thead>
    <tbody>
	';
	
	$query_products	=	mysql_query("SELECT * FROM $database->products WHERE status='publish'ORDER BY name");
	while($list_products = mysql_fetch_assoc($query_products))
	{
		$products['id']				= $list_products['id'];
		$products['status'] 		= $list_products['status'];
		$products['code'] 			= $list_products['code'];
		$products['name'] 			= $list_products['name'];
		$products['purchase_price'] = $list_products['purchase_price'];	
		$products['sale_price'] 	= $list_products['sale_price'];
		
		echo '
		
		<tr>
			<td></td>
			<td><a href="#" class="fnc close-reveal-modal" onClick="product_select(\''.$products['id'].'\', \''.$products['code'].'\');">'.$products['code'].'</a></td>
			<td>'.$products['name'].'</td>
			<td>'.get_calc_amount($products['id']).'</td>
		</tr>
		';	
	}
	
	echo '
		</tbody>
	</table>
	<a class="x close-reveal-modal">&#215;</a></div>';
	
	echo '
	<script>
		function product_select(id, code)
		{
			document.getElementById("'.$product_id.'").value = id;
			document.getElementById("'.$product_code.'").value = code;
		}
	</script>
	';
}


/* ----------------------------------------------
	PRODUCT AMOUNT
---------------------------------------------- */
function product_amount($input_output, $product_id, $shelf, $amount, $fechain, $note)
{
	global $database;
	$input_output 	= safety_filter($input_output);
	$product_id 	= safety_filter($product_id);
	$shelf			= safety_filter($shelf);
	$amount			= safety_filter($amount);
	$fechain		= safety_filter($fechain);
	$note			= safety_filter($note);

	
	if($input_output == 'input')
	{
		$query_amount = mysql_query("SELECT * FROM $database->product_amount WHERE product_id='$product_id' AND shelf='$shelf'");
		if(mysql_num_rows($query_amount) > 0)
		{
			while($list_amount = mysql_fetch_assoc($query_amount))
			{
				$old_amount = $list_amount['amount'];	
			}
			$new_amount = $amount + $old_amount;
			
			add_log($fechain, get_the_current_user('id'), $product_id, $input_output, "[$old_amount]+[$amount]=[$new_amount]", $note);
			
			$update = mysql_query("UPDATE $database->product_amount SET
			amount=amount + $amount
			WHERE product_id='$product_id' AND shelf='$shelf'");
			if(mysql_affected_rows() > 0){return true;	}
			else { if($update == true){ return true; } else { return false; } }
		}
		else
		{
			mysql_query("INSERT INTO $database->product_amount (product_id, shelf, amount) VALUES ('$product_id', '$shelf', '$amount')");
			if(mysql_affected_rows() > 0){ add_log($fechain, get_the_current_user('id'), $product_id, $input_output, "[0]+[$amount]=[$amount]", $date); return true; }
			else{ return false; }
		}	
	}
	else if($input_output == 'output')
	{
		$query_amount = mysql_query("SELECT * FROM $database->product_amount WHERE product_id='$product_id' AND shelf='$shelf'");
		if(mysql_num_rows($query_amount) > 0)
		{
			while($list_amount = mysql_fetch_assoc($query_amount))
			{
				$old_amount = $list_amount['amount'];	
			}
			$new_amount = $old_amount - $amount;
			
			add_log($fechain, get_the_current_user('id'), $product_id, $input_output, "[$old_amount]-[$amount]=[$new_amount]", $note);
			
			$update = mysql_query("UPDATE $database->product_amount SET
			amount=amount - $amount
			WHERE product_id='$product_id' AND shelf='$shelf'");
			if(mysql_affected_rows() > 0){return true;	}
			else { if($update == true){ return true; } else { return false; } }
		}
		else
		{
			$amount = $amount - ($amount * 2);
			mysql_query("INSERT INTO $database->product_amount (product_id, shelf, amount) VALUES ('$product_id', '$shelf', '$amount')");
			if(mysql_affected_rows() > 0){ add_log($fechain, get_the_current_user('id'), $product_id, $input_output, "[0]-[$amount]=[$amount]", $note); return true; }
			else{ return false; }
		}	
	}
}

/* ----------------------------------------------
	PRODUCT CALCULATE THE AMOUNT
---------------------------------------------- */
function get_calc_amount($product_id)
{
	global $database;	
	
	$amount = 0;
	$query_product_amount = mysql_query("SELECT * FROM $database->product_amount WHERE product_id='$product_id'");
	while($list_product_amount = mysql_fetch_assoc($query_product_amount))
	{
		$amount = $amount + $list_product_amount['amount'];
	}
	
	return $amount;
}
function calc_amount($product_id)
{
	echo get_calc_amount($product_id);
}
?>