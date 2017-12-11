<h1>Welcome to the admin panel.</h1>

<p>
    <?php
    echo anchor('dvilsf/logout', 'Logout');
    ?>
</p>

<div class="row-fluid">	

	
				<a class="quick-button metro blue span4">
					<i class="icon-tags"></i>
					<p>Products</p>
					<span class="badge"><?= $num_rows_product ?></span>
				</a>

				<a class="quick-button metro purple span4">
					<i class="icon-envelope"></i>
					<p>New Messages</p>
					<span class="badge"><?= $num_rows_message ?></span>
				</a>
				
				
				<div class="clearfix"></div>
								
			</div><!--/row-->	