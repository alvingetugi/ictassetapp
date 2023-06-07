<?php

/** @var yii\web\View $this */
/** @var \yii\data\ActiveDataProvider $dataProvider */

$this->title = 'ICT Asset App';

?>
<div class="site-index">
    <!-- <div class="p-5 mb-4 bg-transparent rounded-3">
        <div class="container-fluid py-5 text-center">
            <h1 class="display-4">Congratulations!</h1>
            <p class="fs-5 fw-light">You have successfully created your Yii-powered application.</p>
            <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
        </div>
    </div> -->

    <div class="body-content">

        <?php echo \yii\widgets\ListView::widget([
                'dataProvider' => $dataProvider,
                'layout' => '{summary}<div class="row">{items}</div>{pager}',
                'itemView' => '_product_item',
                'itemOptions' => [
                    'class' => 'col-lg-4 col-md-6 mb-4 product-item'
                ],
                'pager' =>[
                    'class' => \yii\bootstrap5\LinkPager::class
                ]
            ]) ?>
    </div>
</div>