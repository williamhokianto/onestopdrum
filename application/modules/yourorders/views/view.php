<h1>Order <?= $order_ref ?></h1>
<p style="font-weight: bold;">Date Created: <?= $date_created ?></p>
<p style="font-weight: bold;">Order Status: <?= $order_status_title ?></p>
<?php
$user_type = 'public';
echo Modules::run('cart/_draw_cart_contents', $query_cc, $user_type);
?>