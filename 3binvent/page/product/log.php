<?php include_once('../../header.php'); ?>



<table class="dataTable">
<thead>
    	<tr>
        	<th width="1"></th>
            <th><?php lang('Fecha'); ?></th>
            <th><?php lang('Usuario'); ?></th>
            <th><?php lang('Nombre'); ?></th>
            <th><?php lang('Tipo'); ?></th>
            <th><?php lang('Operación'); ?></th>
          

		</tr>
	</thead>
    <tbody>
    <?php
	$query_log = mysql_query("SELECT * FROM $database->log ORDER BY date DESC");
	while($list_log = mysql_fetch_assoc($query_log))
	{


		echo '
	
		<tr>

			<td></td>
			
			<td>'.date("d-m-Y", strtotime($list_log['date'])).'</td>
			<td>'.get_user($list_log['user_id'], 'user_name').'</td>
			<td>'.getNombre($list_log['product_id']).'</td>
			<td>'.get_lang($list_log['type']).'</td>
			<td>'.$list_log['text'].'</td>
		
		</tr>

		
		';
	}
	?>
    </tbody>
</table>


<?php include_once('../../footer.php'); ?>