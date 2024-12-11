<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\Alert;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var $roles yii\rbac\Role[] */
/** @var $userRoles yii\rbac\Role[] */

$this->title = "Assign Roles to User: " . $user->username;
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success">
        <?= Yii::$app->session->getFlash('success') ?>
    </div>
<?php endif; ?>

<?php $form = ActiveForm::begin(); ?>

<div class="form-group">
    <label for="roles">Assign Roles</label>
    <div class="form-check">
        <?php foreach ($roles as $role): ?>
            <div class="form-check">
                <?= Html::checkbox(
                    'roles[]',
                    in_array($role->name, ArrayHelper::getColumn($userRoles, 'name')),  // Pre-checked values
                    [
                        'label' => $role->name,
                        'value' => $role->name,
                        'class' => 'form-check-input',
                    ]
                ) ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="form-group">
    <?= Html::submitButton('Save Roles', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>
