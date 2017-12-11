<li>
	<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Manage Orders</span></a>
	<ul>
		<?php
			$target_url = base_url().'store_orders/browse/status0';
			echo '<li><a class="submenu" href="'.$target_url.'">';
			echo '<i class="icon-file-alt"></i><span class="hidden-tablet">';
			echo ' Orders Submitted</span></a></li>';

		foreach ($query_lnl->result() as $row) {
			$target_url = base_url().'store_orders/browse/status'.$row->id;
			echo '<li><a class="submenu" href="'.$target_url.'">';
			echo '<i class="icon-file-alt"></i><span class="hidden-tablet">';
			echo ' '.$row->status_title.'</span></a></li>';
		}
		?>
	</ul>   
</li>