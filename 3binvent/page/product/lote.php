<?php include_once('../../header.php'); ?>

<?php
	mysql_query("DELETE FROM $database->product_amount WHERE amount='0'");
	
	if(isset($_GET['product_id'])){ $product_id = safety_filter($_GET['product_id']);	}
?>
<?php 
$expire = date('d/m/Y');
$text = "Fecha ";
echo $text;
echo  $expire;

 ?>
<table class="datatable"><br><br>
	<thead>
    	<tr>
        	<th width="1"></th>
            <th><?php lang('Nombre del producto'); ?></th>
            <th><?php lang('Lote'); ?></th>
            <th class=""><?php lang('# Lote / # Total'); ?></th>
             <th class=""><?php lang('Vencimiento'); ?></th>
           

        </tr>
	</thead>
    <tbody>
    <?php
	$amount_total = 0;
	if(isset($_GET['product_id'])){ $query_product_amount	=	mysql_query("SELECT * FROM $database->product_amount WHERE product_id='$product_id'"); }
	else { $query_product_amount	=	mysql_query("SELECT * FROM $database->product_amount ORDER BY product_id"); }
	while($list_product_amount = mysql_fetch_assoc($query_product_amount))
	{
		$product_amount['id']			= $list_product_amount['id'];
		$product_amount['product_id'] 	= $list_product_amount['product_id'];
		$product_amount['shelf'] 		= $list_product_amount['shelf'];
		$product_amount['amount'] 		= $list_product_amount['amount'];
		$product_amount['date_tran'] 	= $list_product_amount['date_tran'];
		



//Agregar link para editar fecha de caducidad del lote

		
		echo '
		<tr>
			<td></td>
			<td>'.getNombre($product_amount['product_id']).'</td>
			<td>'.$product_amount['shelf'].'</td>
			<td class="text-left">[ '.$product_amount['amount'].''." / ".''.get_calc_amount($product_amount['product_id']).' ]</td>
		
			<td> <form action = "lote.php" name = "expire" method ="post" ><input style="width: 200" type="date" name="" value="" placeholder="'.$product_amount['date_tran'].'"> <input style="width: 200" type="submit" name="submit" hidden> <form>
			</td>
		</tr>
		';
		
		$amount_total = $amount_total + $product_amount['amount'];
	}
	?>
    </tbody>
    <?php if(isset($_GET['product_id'])) : ?>
    <tfoot>
    	<tr>
        	<th></th>
            <th></th>
            <th></th>
            <th class="text-right">saS<?php echo $amount_total; ?></th>
        </tr>
    </tfoot>
    <?php endif; ?>
</table>


<?php include_once('../../footer.php'); ?>