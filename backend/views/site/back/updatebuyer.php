<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Update Buyer: ' . ' ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Buyer', 'url' => ['buyer']];
$this->params['breadcrumbs'][] = ['label' => $model->username];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formbuyer', [
        'model' => $model,
    ]) ?>

</div>
