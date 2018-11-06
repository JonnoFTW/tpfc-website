<div class="col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <? echo anchor('admin/store', 'Store') ?> - Orders
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Paid?</th>
                </tr>
            </thead>
            <tbody>
                <?
                    foreach($orders as $o) {
                    ?>
                        <tr class="clickable-row" data-href="<? echo site_url("admin/store/order/{$o['order_id']}");?>">
                            <td><? echo anchor("admin/store/order/{$o['order_id']}",$o['order_id']); ?></td>
                            <td><? echo $o['name']?></td>
                            <td><? echo mailto($o['email'])?></td>
                            <td><? echo $o['paid']?"Yes":"No" ?></td>
                        </tr>
                    <?
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
$(".clickable-row").click(function () {
    window.location = $(this).data('href');
});
</script>
