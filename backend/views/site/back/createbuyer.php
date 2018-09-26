<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Create Buyer';
$this->params['breadcrumbs'][] = ['label' => 'Buyer', 'url' => ['buyer']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formbuyer', [
        'model' => $model,
    ]) ?>

</div>
