<?php

?>

<style>
#product_code           {   font-size:36px; height:60px;    }
#product_code:focus     {   border:1px solid #f00;          }
#shelf:focus            {   border:1px solid #f00;          }
#amount                 {   font-size:36px; height:60px;    }
#amount:focus           {   border:1px solid #f00;          }
</style>
            
<form name="form_add" id="form_add" action="" method="POST">
<div class="row">
    <div class="twelve columns">
        <fieldset>
            <legend><?php lang('Ingrese código'); ?></legend>
            
            <div class="row">
                <div class="ten columns">
                    <?php box_product_list('product_id', 'product_code'); ?>
                    <a href="#" class="button secondary small " data-reveal-id="box_product_list" data-animation="fadeAndPop" ><?php lang('Product List'); ?></a>
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

                    </div> 
                </div>

            </div> 
            </form>
                <!-- Input -->
            <div class="row">
                <div class="ten columns">
                    <label for="product_code"><?php lang('Product Code'); ?></label><br>
                    <input type="text" name="product_code" id="product_code" class="required" maxlength="50" minlength="3" placeholder="<?php lang('Ingrese el código del elemento'); ?>" />
                </div>
           </div> 
           <a href="log.php?product_id=">Hola</a>
            <!-- Scan imagen -->
        <div class="row">
                <div class="ten columns">
                    <div class="text-center">
                        <img src="<?php url('theme'); ?>/images/barcode_scaner.gif" />
                    </div>
                </div>
                
            </div>
        </fieldset>    
    </div>
</div>


</form>

<script>
document.getElementById('prod_code').focus();
</script>