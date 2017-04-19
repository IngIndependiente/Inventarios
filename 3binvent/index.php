<?php include_once('header.php'); ?>

<div class="row">
	<div class="six columns">
    	<div class="row">
        	<div class="six columns">
            	<div class="panel text-center">
                	<h5><?php lang('Entrada'); ?></h5>
            		<a href="<?php url('page'); ?>/input-output/input-output.php?input"><img src="<?php url('theme'); ?>/images/icon/128/fork1.png" title="<?php lang('Product Input'); ?>" /></a>
                </div>
            </div>
            <div class="six columns">
            	<div class="panel text-center">
                	<h5><?php lang('Salida'); ?></h5>
            		<a href="<?php url('page'); ?>/input-output/input-output.php?output"><img src="<?php url('theme'); ?>/images/icon/128/fork4.png" title="<?php lang('Product Output'); ?>" /></a>
                </div>
            </div>
        </div> <!-- /.row -->
    </div> <!-- /.six columns -->
    <div class="six columns">
    	<div class="row">
       <div class="six columns">
                    <div class="panel text-center">
                        <h5><?php lang('Warehouse'); ?></h5>
                        <a href="<?php url('page'); ?>/product/log.php"><img src="<?php url('theme'); ?>/images/icon/128/self1.png" title="<?php lang('Warehouse'); ?>" /></a>
                    </div> 
                </div>
                <div class="six columns">
                    <div class="panel text-center">
                        <h5><?php lang('Listado'); ?></h5>
                        <a href="<?php url('page'); ?>/product/product_list.php"><img src="<?php url('theme'); ?>/images/icon/128/palet02.png" title="<?php lang('Product List'); ?>" /></a>
                    </div>
                </div>
            </div>
    	</div> <!-- /.row -->
    </div> <!-- /.six columns -->
</div> <!-- /.row -->


  
<?php include_once('footer.php'); ?>