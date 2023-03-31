<?php

/** @var \common\models\Product $model*/

?>

    <div class="col mb-5">
        <div class="card h-100">
            <!-- Product image-->
            <img class="card-img-top" src="<?php echo $model->getImageUrl()?>" alt="..." />
            <!-- Product details-->
            <div class="card-body p-4">
                <div class="text-center">
                    <!-- Product name-->
                    <h5 class="fw-bolder"><?php echo $model->name?></h5>
                    <!-- Product price-->
                    <div>
                        <?php echo Yii::$app->formatter->asCurrency($model->price) ?>
                    </div>
                </div>
            </div>
            <!-- Product actions-->
            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                <div class="text-center"><a class="btn btn-primary" href="#">Issue</a></div>
                <!-- <small class="text-muted">&#9733;&#9733;&#9733;&#9733;</small> -->
            </div>
        </div>
    </div>