<?php include_once('../../header.php'); ?>


<?php
if(isset($_GET['product_id']))
{
    $product_id = safety_filter($_GET['product_id']);   
}
else
{
    alert_box('alert', get_lang('Ingrese la ID del producto'));
}
?>

<?php
if(isset($_GET['success']))
{
    alert_box('success', get_lang('Muestra actualizada'));
}

if(isset($_POST['btn_update_product']))
{
    $code           =   safety_filter($_POST['code']);  
    $name           =   safety_filter($_POST['name']);  
    $purchase_price =   safety_filter($_POST['purchase_price']);    
    $sale_price     =   safety_filter($_POST['sale_price']);
    $status         =   safety_filter($_POST['status']);  
    $product_type   =   safety_filter($_POST['product_type']);
    $status         =   safety_filter($_POST['status']);  
    $product_type   =   safety_filter($_POST['product_type']); 
    $supplier       =   safety_filter($_POST['supplier']);
    $email          =   safety_filter($_POST['email']);
    $phone          =   safety_filter($_POST['phone']);
    $stock          =   safety_filter($_POST['stock']);
    $date_expire    =   safety_filter($_POST['date_expire']);
    $over_stock     =   safety_filter($_POST['over_stock']);
    
    $custom_field_1 =   safety_filter($_POST['custom_field_1']);
    $custom_field_2 =   safety_filter($_POST['custom_field_2']);
    $custom_field_3 =   safety_filter($_POST['custom_field_3']);
    $custom_field_4 =   safety_filter($_POST['custom_field_4']);
    $custom_field_5 =   safety_filter($_POST['custom_field_5']);
    
    if(update_product(get_the_product('id'), $status, $code, $name, $purchase_price, $sale_price, $product_type, $supplier, $email, $phone, $stock, $date_expire, $over_stock))
    {
        update_meta('', get_the_product('id'), 'product', 'custom_field_1', $custom_field_1);
        update_meta('', get_the_product('id'), 'product', 'custom_field_2', $custom_field_2);
        update_meta('', get_the_product('id'), 'product', 'custom_field_3', $custom_field_3);
        update_meta('', get_the_product('id'), 'product', 'custom_field_4', $custom_field_4);
        update_meta('', get_the_product('id'), 'product', 'custom_field_5', $custom_field_5);
        
        echo '<script> window.location = "product.php?product_id='.get_the_product('id').'&success"; </script>';    
    }
    else
    {
        alert_box('alert', get_lang('No es posible actualizar la muestra'));
    }
}
?>



<form name="form_update" id="form_update" action="?product_id=<?php the_product('id'); ?>" method="POST">
<div class="row">
    <div class="four columns">
        <fieldset>
            <legend><?php lang('Actualizar muestra'); ?></legend>
            
            

            <label for="name"><?php lang('Nombre de la muestra'); ?></label>
            <input type="text" name="name" id="name" class="required" maxlength="50" minlength="3" value="<?php the_product('name'); ?>" />

            <label for="name"><?php lang('Tipo de muestra'); ?></label>
            <input type="text" name="product_type" id="product_type" class="required" maxlength="50" minlength="3" value="<?php the_product('product_type'); ?>" />

             <label for="name"><?php lang('Stock Critico'); ?></label>
            <input type="number" name="stock" id="stock" class="required" maxlength="50" minlength="1" value="<?php the_product('stock'); ?>" />
            
            <label for="name"><?php lang('Sobre Stock'); ?></label>
            <input type="number" name="over_stock" id="over_stock" class="required" maxlength="50" minlength="1" value="<?php the_product('over_stock'); ?>" />


            <label for="name"><?php lang('Proveedor'); ?></label>
            <input type="text" name="supplier" id="supplier" class="required" maxlength="50" minlength="3" value="<?php the_product('supplier'); ?>" />

           


            <div class="row">
                <div class="six columns">
                    <label for="purchase_price"><?php lang('Potencia'); ?></label>
                    <input type="text" name="purchase_price" id="purchase_price" class="number just_money" placeholder="" value="<?php the_product('purchase_price'); ?>" maxlength="20" />
                </div> <!-- /.six columns -->
                
            </div> <!-- /.row -->
            <label for="code"><?php lang('Código de la muestra'); ?></label>
            <input type="text" name="code" id="code" class="required" maxlength="50" minlength="1" value="<?php the_product('code'); ?>" />
            
            <label for="status"><?php lang('Acción'); ?></label><br>
            <select name="status" id="status">
                <option value="publish" <?php if(get_the_product('status') == 'publish') {echo 'selected';} ?>><?php lang('Actualizar'); ?></option>
                <option value="delete" <?php if(get_the_product('status') == 'delete') {echo 'selected';} ?>><?php lang('Eliminar'); ?></option>
            </select>
            
            <p></p>
        </fieldset>    
    </div> <!-- /.four columns -->
    


    <div class="four columns">
        <fieldset>
            <legend><?php lang('Unidades'); ?></legend>
            <div class="panel text-center">
                <h1><?php echo $amount = get_calc_amount(get_the_product('id')); ?></h1>
                <?php if($amount > 0) : ?><?php endif; ?>
            </div>
        </fieldset>
        <fieldset>
            <legend><?php lang('Product Barcode'); ?></legend>
            <div class="panel text-center"><img src="<?php url(''); ?>/include/class/barcode/barcode.php?barcode=<?php the_product('code'); ?>" /></div>
        </fieldset>
          <ul class="button-group">
              <!--<li><a href="log.php?product_id=<?php the_product('id'); ?>" class="button secondary"><?php lang('Log'); ?></a></li> -->
              <li><a href="#" onClick="popup_barcode_print();" class="button secondary"><?php lang('Imprimir Código'); ?></a></li>
            </ul>
    </div>
</div> <!-- /.row -->

<div class="row">
    <div class="four columns">
        <input type="submit" name="btn_update_product" id="btn_update_product" class="button secondary" value="<?php lang('Update'); ?>" />
    </div> <!-- /.four columns -->
    <div class="eight columns">
        <div style="float:right;">
            <script>
            function popup_barcode_print()
            {
                    window.open ('<?php echo url(''); ?>/include/class/barcode/barcode_show.php?barcode=<?php the_product('code'); ?>&print='+ true +'','mywindow','menubar=0,resizable=0,width=300,height=300');   
            }
            </script>
          
        </div>
    </div>
</div> <!-- /.row -->

</form>


<?php include_once('../../footer.php'); ?>