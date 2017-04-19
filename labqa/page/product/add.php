<?php include_once('../../header.php'); ?>

<?php
if(isset($_POST['btn_add_product']))
{
	$code			=	safety_filter($_POST['code']);	
	$name			=	safety_filter($_POST['name']);	
	$purchase_price	=	safety_filter($_POST['purchase_price']);	
	$sale_price		=	safety_filter($_POST['sale_price']);
    $product_type   =   safety_filter($_POST['product_type']);
    $supplier       =   safety_filter($_POST['supplier']);
    $email          =   safety_filter($_POST['email']);
    $phone          =   safety_filter($_POST['phone']);
    $stock          =   safety_filter($_POST['stock']);
    $date_expire    =   safety_filter($_POST['date_expire']);
    $over_stock     =   safety_filter($_POST['over_stock']);
    
    
 
	
	$product_id = 0;
	$product_id = add_product($code, $name, $purchase_price, $sale_price, $product_type, $supplier, $email, $phone, $stock, $date_expire, $over_stock);
	if($product_id > 0)
	{
		alert_box('success', get_lang('Muestra ingresada'));;
	}
	else
	{
		alert_box('alert', get_lang('No es posible ingresar la muestra'));	
	}
}
?>

<form ng-app ="" name="form_add" id="form_add" action="" method="POST" >
<div class="row" >

	<div class="four columns" >
    	<fieldset>
			<legend><?php lang('Agregar Muestra'); ?></legend>
  
            <label for="name"><?php lang('Nombre de la muestra *'); ?></label>
            <input ng-model="name" type="text" name="name" id="name" maxlength="100" minlength="1" required />   

            <label for="name"><?php lang('Tipo de muestra *'); ?></label>
            <input ng-model="product_type" type="text" name="product_type" id="product_type" maxlength="50" minlength="1" required/>

            <label for="name"><?php lang('Proveedor'); ?></label>
            <input ng-model="supplier" type="text" name="supplier" id="supplier" maxlength="50" minlength="3" />

            <label for="stock"><?php lang('Stock crítico *'); ?></label>
            <input ng-model="stock" type="number" name="stock" id="stock" maxlength="20" minlength="1" required="required" />

            <label for="stock"><?php lang('Sobre Stock'); ?></label>
            <input ng-model="over_stock" type="number" name="over_stock" id="over_stock" maxlength="20" minlength="1" />
         

           
                <div class="row">
                <div class="six columns">
                    <label for="purchase_price"><?php lang('Potencia *'); ?></label>
                    <input  ng-model="purchase_price" type="text" name="purchase_price" id="purchase_price" class="number just_money" placeholder="%" required />

                </div> <!-- /.six columns -->
         
            </div> <!-- /.row -->
            <label for="code"><?php lang('Código de la muestra *'); ?></label>
            <input ng-model="code" type="text" name="code" id="code" maxlength="100" minlength="1" required />  
            <div class="row">
                <div class="four columns">
                    <input ng-disabled ="form_add.$invalid"  type="submit" name="btn_add_product" id="btn_add_product" class="button" value="<?php lang('Add'); ?> &raquo;" />
                </div> <!-- /.four columns -->
            </div> <!-- /.row -->
			<p></p>
    	</fieldset>    
    </div> <!-- /.four columns -->
</div> <!-- /.row -->


</form>

<?php include_once('../../footer.php'); ?>