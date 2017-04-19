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
	if(isset($_POST['date_tran'])) { 
		$date_tran = safety_filter($_POST['date_tran']);
		$id = safety_filter($_POST['super_id']);
		mysql_query("UPDATE $database->product_amount SET date_tran = '$date_tran' WHERE id='$id'");
		$query_product_amount = mysql_query("SELECT * FROM $database->product_amount ORDER BY product_id");
		}
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
			
			<td>'.getNombre($product_amount['product_id']).'<input type="hidden" name="super_id" value = "'.$product_amount['id'].'" /> </td>
			<td>'.$product_amount['shelf'].' </td>
			<td class="text-left">[ '.$product_amount['amount'].''." / ".''.get_calc_amount($product_amount['product_id']).' ]</td>
			<form name ="form_add" method ="POST" >
			<td> <input style="width: 200" type="date" name="date_tran" value="'.$product_amount['date_tran'].'" placeholder=""> 
			<button type="btm">Cambiar</button></form>
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