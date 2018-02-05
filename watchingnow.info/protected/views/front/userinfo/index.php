
<h1 id="pagetitle"><?php echo Yii::t('t','Profile') ?></h1>
<div class="container main" id="page">			<div style="float:left; width:50%; padding:30px;">
<script src="//vk.com/js/api/openapi.js" type="text/javascript"></script>
<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

//$this->menu=array(
//	array('label'=>'List Users', 'url'=>array('index')),
//	array('label'=>'Create Users', 'url'=>array('create')),
//	array('label'=>'View Users', 'url'=>array('view', 'id'=>$model->id)),
//	array('label'=>'Manage Users', 'url'=>array('admin')),
//);
?>
<?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>



<?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>

</div>