<h1 id="pagetitle"><?php echo Yii::t('t','I cant wait to see this movies'); ?></h1>
<div class="container main" id="page">			

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'films-form',
	'action'=>Yii::app()->createUrl('films/make'),
	'htmlOptions'=>array(
                               'onsubmit'=>" send(); return false;",
                             
                             ),  
)); ?>

<div class="row">
	
		<?php echo $form->TextField($model,'name',array('class'=>'todofield')); ?>
		
</div>
<br />
<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('t','Add')); ?>
</div>

<?php $this->endWidget(); ?>
<br />
<?php $this->renderPartial('list_',array('list'=>$list)); ?>
<div class="success_container"><div class="message_success" style="display:none;"></div></div>
<script type="text/javascript">
 $(document).ready(function(){
 $(".todofield").focus();
 $(".todofield").autocomplete("<?php echo Yii::app()->baseUrl; ?>/site/autocomplete");
 });
 function Delete(todoid){
	if(confirm('<?php echo Yii::t('t',"Are you sure?"); ?>')){
		 $.ajax({
		   type: 'POST',
			url: '<?php echo Yii::app()->createUrl('films/deletetodo'); ?>',
		   data: { todoid: todoid },
		success:function(data){
						
						$('#list').html(data);
						MessageAlert("<?php echo Yii::t('t','Done') ?>");
						},
		   error: function(data) { // if error occured
				 alert("Error occured.please try again");
				 alert(data);
			},
		 
		  dataType:'html'
		  });
	}
 }
function send()
 {
 
   var data1=$("form").serialize();
   
	if($('#Todo_name').val()==''){MessageAlert("<?php echo Yii::t('t','Field is empty'); ?>"); return;}
  $.ajax({
   type: 'POST',
    url: '<?php echo Yii::app()->createUrl('films/todo'); ?>',
   data:data1,
   
success:function(data){

				
                $('#list').html(data);
				$('#Todo_name').val('');
				MessageAlert("<?php echo Yii::t('t','Added') ?>");
				},
   error: function(data) { // if error occured
         alert("Error occured.please try again");
         alert(data);
    },
 
  dataType:'html'
  });
 
}
 
</script></div>