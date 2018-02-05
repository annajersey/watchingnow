<h1 id="pagetitle"><?php echo Yii::t('t','{username} films list',array('{username}'=>$username)); ?></h1>
<div class="container main" id="page">			


<div class="userlist_wrapper">
<?php
 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'filmslist',
	'dataProvider'=>$model->userfilmlist(),
	'filter'=>$model,
	'pager' => array(
                'header' => '',
        ), 
	'columns'=>array(
		array(
		
		'name'=>'datetime',
		'value'=>'date("Y-m-d H:i",$data->timestamp)',
		'sortable' => true,
		
		),
		
		'name',
		array(
		'type'=>'raw',
		'name'=>'favorite',
		'value'=>'$data->getStarStatic()',
		'sortable' => true,
		'htmlOptions'=>array('width'=>'5%'),
		'filter'=>array('1'=>'Only Favorite'),
		),
	),
)); 
?>
</div></div>