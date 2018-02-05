<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	

	<?php echo $form->errorSummary($model); ?>
	<!--<img src="<?php echo Yii::app()->request->baseUrl;?>/images/<?php echo $model->id; ?>.jpg">-->
	
	 <div class="row">
		<?php echo $form->labelEx($model,'login'); ?>
		<?php echo $form->textField($model,'login',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'login'); ?>
	</div> 
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
<!--	<div class="row">
	<?php echo $form->labelEx($model, 'image'); ?>
	<?php echo $form->fileField($model, 'image'); ?>
	<?php echo $form->error($model, 'image'); ?>
	</div>-->
	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	<div class="row">
	<label>Password Confirm</label>
	<?php echo $form->passwordField($model,'password2',array('size'=>60,'maxlength'=>255)); ?>
	<?php echo $form->error($model,'password2'); ?>
	</div>		
	<div class="row buttons">
		<?php echo CHtml::submitButton( Yii::t('t','Create')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
<script> 
$(function() {
$('#Users_password,#Users_password2').val('');
$('#Users_password,#Users_password2').click(function(){$(this).val('');});
});
 </script>

 <?php 
//phpinfo();
//$email = 'jeremy-l@list.ru';
//$headers = 'From: ' .$email . "\r\n". 
  //'Reply-To: ' . $email. "\r\n" . 
//  'X-Mailer: PHP/' . phpversion();


 //mail('jeremy-l@list.ru','test','test3', $headers);
 ?>