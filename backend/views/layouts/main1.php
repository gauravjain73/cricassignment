<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\models\User;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
 
    <div class="wrap">
	
        <?php
           NavBar::begin([
                'brandLabel' => '<img style="max-width:100px; margin-top: -7px;" src="'.Yii::$app->urlManagerFrontend->createUrl(['images/logo.png']).'">',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top logo',
                ],
            ]);
            $menuItems = [
                ['label' => 'Home', 'url' => ['/site/index']],  
              
            ];
            if (!Yii::$app->user->isGuest) {
            $menuItems[]=['label' => 'Users',
				'items' => [				
				['label' => 'Subadmin', 'url' => ['/user/subadmin'],'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->utid == User::UTID_ADMIN],
				['label' => 'Buyer', 'url' => ['/user/buyer']],
				['label' => 'Agent', 'url' => ['/user/agent']],
				['label' => 'Seller', 'url' => ['/user/seller']],
				['label' => 'Vendor', 'url' => ['/user/vendor']],
				],
			];
            $menuItems[]=['label' => 'Property',
				'items' => [
				['label' => 'Amenity', 'url' => ['/amenities']],
				['label' => 'Property Type', 'url' => ['/property-type']],
				['label' => 'Property Feature', 'url' => ['/property-features']],
				['label' => 'Property Form Type', 'url' => ['/property-form-type']],
				['label' => 'Property Form', 'url' => ['/property-form']],
				['label' => 'Property Form Field', 'url' => ['/property-form-field']],
			/*	['label' => 'Amenity', 'url' => ['/amenities-details']], */
			/*	['label' => 'Property Categories', 'url' => ['/user/agents']],
				['label' => 'Sellers', 'url' => ['/user/seller']],
				['label' => 'Vendor', 'url' => ['/user/vendor']],*/
				],
			];
            $menuItems[]=['label' => 'Locality',
				'items' => [
				['label' => 'Country', 'url' => ['/country']],
				['label' => 'State', 'url' => ['/state']],
				['label' => 'City', 'url' => ['/city']],
				['label' => 'Zip', 'url' => ['/zip']],
			//	['label' => 'Locality', 'url' => ['/locality']],
				
				],
			];
            $menuItems[]=['label' => 'Config',
				'items' => [
				['label' => 'Configuration', 'url' => ['/configuration']],
				['label' => 'Slider', 'url' => ['/slider']],
				['label' => 'Menu', 'url' => ['/menu']],
				['label' => 'Testimonial', 'url' => ['/testimonials']],
				['label' => 'Widget', 'url' => ['/widgets']],
				['label' => 'CMS Page', 'url' => ['/cms-page']],
				],
			];
		}
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
                $menuItems[] = ['label' => 'Settings (' . Yii::$app->user->identity->fname .')',
				'items' => [
					/*['label' => 'Edit Profile',
                    'url' => ['/user/update?id='.Yii::$app->user->identity->id.''],
                    'linkOptions' => ['data-method' => 'post'],'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->utid == User::UTID_ADMIN], */
                    ['label' => 'Edit Profile',
                    'url' => ['/user/editprofile'],
                    'linkOptions' => ['data-method' => 'post']],
                   
                    
                    ['label' => 'Logout',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']],
                    
                ],
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end(); 
        ?>
        <div class="container">
        <?php  if (!Yii::$app->user->isGuest) {?>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?php }?>
        <?php
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>

        <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; Listitopen <?= date('Y') ?></p>
        <!--p class="pull-right"><?= Yii::powered() ?></p-->
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
