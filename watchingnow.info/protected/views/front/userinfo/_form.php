<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>


	<?php echo $form->errorSummary($model); ?>
	 <?php $image=Yii::app()->request->baseUrl."/images/".$model->id.".jpg"; 
$image2=dirname(Yii::app()->request->scriptFile)."/images/".$model->id.".jpg"; 


if(false && file_exists($image2)){ ?>
	<img src="<?php echo $image; ?>"> <br /><br />
	<?php } ?>
	  
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	<!--<div class="row">
	<?php echo $form->labelEx($model, 'image'); ?>
	<?php echo Yii::t('t',$form->fileField($model, 'image')); ?>
	<?php echo $form->error($model, 'image'); ?>
	</div>-->
	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('t','Save')); ?>
	</div>

<?php $this->endWidget(); ?>


 </script>
 <a href="userinfo/change_password"><?php echo Yii::t('t','Change password'); ?></a>
 </div>