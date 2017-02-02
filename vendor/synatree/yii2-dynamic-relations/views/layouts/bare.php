<?php
use yii\helpers\Html;
use synatree\dynamicrelations\Module;

/* @var $this \yii\web\View */
/* @var $content string */

$assetClass = Module::getInstance()->appAsset;
$assetClass::register($this);

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="icon" href="<?= Yii::getAlias("@web/favicon.ico"); ?>">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
	<div id="root">
		<div class="row">
			
			<div class="col-sm-11">
				<?= $content ?>
			</div>
			<div class="col-sm-1">
				<button type="button" class="btn btn-block btn-default btn-sm  remove-dynamic-relation" aria-label="Remove"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
			</div>
		</div>
	    
            
	</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
