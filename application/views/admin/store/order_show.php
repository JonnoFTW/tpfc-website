<div class="col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <? echo anchor('admin/store', 'Store') ?> - <? echo anchor('admin/store/orders','Orders'); ?>
        </div>
        <div class="panel-body">
        <h3>Order for <? echo $order['name']?></h3>
        <b>Email:</b> <? echo mailto($order['email']);?><br>
        <b>Paid:</b> <? echo $order['paid']?"Yes":"No";?>
        <?
            $total = 0;
            foreach($order['items'] as $i) {
                echo heading($i['name'],3);
                echo heading("Price: ".price($i['price']),5);
                echo heading("Quantity: {$i['quantity']}",5);
                $total += $i['quantity'] * $i['price'];
                foreach($i['attrs'] as $a) {
                    echo heading("{$a['attribute']}: {$a['value']}", 5);
                }            
                
            }        
            echo heading("Total: ".price($total),4);
        ?>

        </div>

    </div>
</div>

