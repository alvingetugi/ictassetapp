<?php
/** @var array $items */
?>

<div class="card">
    <div class="card-header">
        <h3>Your Asset List</h3>
    </div>
    <div class="card-body p-0">

    <?php if(!empty($items)): ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Asset</th>
                    <th>Image</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td>
                            <?php echo $item['name'] ?>
                        </td>
                        <td>
                            <img src="<?php echo \common\models\Product::formatImageUrl($item['image'])  ?>"
                                style="width: 50px" alt="<?php echo $item['name'] ?>">
                        </td>
                        <td>
                            <?php echo $item['price'] ?>
                        </td>
                        <td>
                            <?php echo $item['quantity'] ?>
                        </td>
                        <td>
                            <?php echo $item['total_price'] ?>
                        </td>
                        <td>
                            <?php echo \yii\helpers\Html::a('Delete', ['/cart/delete', 'id' => $item['id']], [
                                'class' => 'btn btn-outline-danger btn_sm',
                                'data-method' => 'post',
                                'data-confirm' => 'Are you sure you want to remove this asset?'
                            ]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="card-body text-end">
            <a href="<?php echo \yii\helpers\Url::to(['/cart/checkout']) ?>" class="btn btn-primary">Add to request</a>
        </div>
        <?php else: ?>
            <p class="text-muted text-center p-5">There are no assets in your request bag</p>
        <?php endif; ?>

    </div>
</div>