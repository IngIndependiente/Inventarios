<?php include_once('../../header.php'); ?>

<table class="dataTable">
	<thead>
    	<tr>
        	<th></th>
            <th><?php lang('Code'); ?></th>
            <th><?php lang('Producto'); ?></th>
            <th><?php lang('Amount'); ?></th>
            <th><?php lang('Precio'); ?></th>
            <th class="text-right"><?php lang('Tipo'); ?></th>
            <th class="text-right"><?php lang('Proveedor'); ?></th>
            <th class="text-right"><?php lang('Estado Stock'); ?></th>
            
            
           
        </tr>
	</thead>
    <tbody>
    <?php
	$query_products	=	mysql_query("SELECT * FROM $database->products WHERE status='publish'ORDER BY name");
	while($list_products = mysql_fetch_assoc($query_products))
	{
		$products['id']				= $list_products['id'];
		$products['status'] 		= $list_products['status'];
		$products['code'] 			= $list_products['code'];
		$products['name'] 			= $list_products['name'];
		$products['purchase_price'] = $list_products['purchase_price'];	
		$products['sale_price'] 	= $list_products['sale_price'];
		$products['product_type'] 	= $list_products['product_type'];
		$products['supplier'] 	= $list_products['supplier'];
		$products['stock'] 	= $list_products['stock'];
		$products['date_expire'] 	= $list_products['date_expire'];
		$products['over_stock'] 	= $list_products['over_stock'];
		
		$amount = get_calc_amount($products['id']);
		
		if ($amount == 0 ) {
			$color = "green";
			$note = $amount;
			
		}
		if ($amount <=$products['stock'] && $amount > 0 ) {
			$color = "red";
			$note = $amount;
		}
		if ($products['over_stock'] <= $amount) {
			$color = "yellow";
			$note = $amount - $products['over_stock'];
		} 
		
		if($amount > $products['stock'] && $amount < $products['over_stock']){
		
			$color = "green";
			$note = $amount;
		};
		

		echo '
		<tr>
			<td></td>
			<td><a href="'.get_url('page').'/product/product.php?product_id='.$products['id'].'">'.$products['code'].'</a></td>
			<td>'.$products['name'].'</td>
			<td>'.get_calc_amount($products['id']).'</td>
			<td>'.$products['purchase_price'].''."%".'</td>
			<td class="text-right">'.$products['product_type'].'</td>
			<td class="text-right">'.$products['supplier'].'</td>
			<td class="text-right '.$color.'">'.$note.'</td>
		
			
			
			
		</tr>
		';	
	}
	?>
    </tbody>
</table>


<?php include_once('../../footer.php'); ?>