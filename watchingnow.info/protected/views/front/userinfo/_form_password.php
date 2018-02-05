<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form" id="form_password">
<?php $form=$this->beginWidget('CActiveForm', array(
	
	
	'enableAjaxValidation'=>true
)); ?>


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
		<?php echo CHtml::submitButton(Yii::t('t','Save')); ?>
	</div>
<?php $this->endWidget(); ?>	
</div><!-- form -->
<script> 
$(function() {
$('#Users_password').val('');
$('#Users_password').click(function(){$(this).val('');});
});
 </script>