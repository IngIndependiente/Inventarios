<?php include_once('../../header.php'); ?>

<?php
if(isset($_GET['input']))       { $input_output = 'input';  }
else if(isset($_GET['output'])) { $input_output = 'output'; }
else { alert_box('alert', get_lang('No hay valor de entrada o salida')); exit;  }
?>
<?php
  $timezone = "Chile/Continental";
  date_default_timezone_set($timezone);
  $today = date("Y-m-d");
?>
<?php
$shelf = '';
if(isset($_POST['btn_submit']))
{
    $continue       = true;
    $product_id     =   safety_filter($_POST['product_id']);
    $product_code   =   safety_filter($_POST['product_code']);
    $shelf          =   safety_filter($_POST['shelf']);
    $amount         =   safety_filter($_POST['amount']);
    $fechain        =   safety_filter($_POST['fechain']);
    $note           =   safety_filter($_POST['note']);


    
    
    if($product_id == '')
    {

        $query_product = mysql_query("SELECT * FROM $database->products WHERE status='publish' AND code='$product_code' ORDER BY name");  
        while($list_product = mysql_fetch_assoc($query_product))
        {
            $product_id = $list_product['id'];
        }
    }
    
    if($product_id == ''){ $continue = false; alert_box('alert', get_lang('El producto no se encuentra registrado')); }


    if ($continue == true && $input_output == 'output') 
    {
        $var1 = get_calc_amount($product_id);
        $test = $var1 - ($amount);
        if ($test < 0) {
            $continue = false;
            alert_box('alert','Stock insuficiente');
        }
    }

    if($continue == true)
    {
        if(product_amount($input_output, $product_id, $shelf, $amount,$fechain,$note))
        {
            
            alert_box('success', get_lang('Stock actualizado'));
        }
    }
}

?>

<style>
#product_code           {   font-size:36px; height:60px;    }
#product_code:focus     {   border:1px solid #f00;          }
#shelf:focus            {   border:1px solid #f00;          }
#amount                 {   font-size:36px; height:60px;    }
#amount:focus           {   border:1px solid #f00;          }
</style>
            
<form  name="form_add" id="form_add" action="" method="POST">
<div class="row">
    <div class="twelve columns">
        <fieldset>
            <legend><?php lang($input_output); ?></legend>
            
            <div class="row">
                <div class="ten columns">
                    <?php box_product_list('product_id', 'product_code'); ?>
                    <a href="#" class="button secondary small " data-reveal-id="box_product_list" data-animation="fadeAndPop" ><?php lang('Search'); ?></a>
                </div>
                <div class="two columns">
                    <div class="row collapse">
                        <div class="two mobile-one columns">
                            <script> 
                                function popup_barcode_print()
                                {
                                    var shelf = document.getElementById('shelf').value; 
                                    if(shelf == '')
                                    {
                                        document.getElementById('shelf').focus();
                                    }
                                    else
                                    {
                                        window.open ('<?php echo url(''); ?>/include/class/barcode/barcode_show.php?barcode=' + shelf + '&print='+ true +'','mywindow','menubar=0,resizable=0,width=300,height=300');   
                                    }
                                }
                            </script>
                         
                        </div>
                        <div class="ten mobile-three columns"><br><br>
                          
                          
                        </div>
                    </div> <!-- /.row collapse -->
                </div>
            </div> <!-- /.row -->
            
            
            <div class="row">
                <div class="nine columns">
                    <br><label for="product_code"><?php lang('Product'); ?></label>
                    <input ng-model="product_code" required="requiered" type="text" name="product_code" id="product_code" maxlength="50" minlength="1" placeholder="<?php lang('Product Code'); ?>" />
                   
                </div>
                <div class="three columns">
                
                    <label for="amount"><?php lang(); ?></label><br><br>
                    <input  type="text" name="amount" id="amount" required="" ng-model ="amount" placeholder="<?php lang('Amount'); ?>" required/>
             

       
  <?php 
        $lote1    = "Lote 1";
        $lote2    = "Lote 2";
        $lote3    = "Lote 3";
        $almacen1 = "Almacen 1";
        $almacen2 = "Almacen 2";
        $almacen3 = "Almacen 3";
        
    
        
  
     ?>
                    <select name="shelf" id="shelf">
                    <option value="<?php lang($lote1); ?>"><?php echo $lote1; ?></option>
                    <option value="<?php lang($lote2); ?>"><?php echo $lote2; ?></option>
                    <option value="<?php lang($lote3); ?>"><?php echo $lote3; ?></option>
                    </select><br><br>


                     <input ng-model="date" type="date" name="fechain" id="fechain"  maxlength="11" minlength="2" value="<?php echo $today; ?>" />

                    
                </div>
           </div>
            
            <div class="row">
                <div class="ten columns">
                    <div class="text-center">
                        <img src="<?php url('theme'); ?>/images/barcode_scaner.gif" />
                    </div>
                </div>

                <div class="two columns">
                    <input ng-model="product_id" type="hidden" name="product_id" id="product_id" value="" />
                    <?php if($input_output == 'input') : ?>
                        <input ng-disabled="form_add.$invalid" type="submit" name="btn_submit" id="btn_submit" class="button large full-width" value="&laquo; <?php lang('Input'); ?>" />
                    <?php elseif ($input_output == 'output') : ?>
                        <input ng-disabled ="form_add.$invalid" type="submit" name="btn_submit" id="btn_submit" class="button large full-width" value="<?php lang('Output'); ?> &raquo;" />
                    <?php endif; ?>
                </div>
            </div>
            <p></p>
        </fieldset>    
    </div> <!-- /.four columns -->
</div> <!-- /.row -->


</form>

<script>
document.getElementById('prod_code').focus();
</script>

<?php include_once('../../footer.php'); ?>