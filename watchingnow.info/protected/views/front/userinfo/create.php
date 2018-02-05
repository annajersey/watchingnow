<?php
/* @var $this UsersController */
/* @var $model Users */




?>
<h1 id="pagetitle"><?php echo Yii::t('t','Register'); ?></h1>

<div class="container main" id="page">			

<?php $this->renderPartial('_form_create', array('model'=>$model)); ?>
</div>