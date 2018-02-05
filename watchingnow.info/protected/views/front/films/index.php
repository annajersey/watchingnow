<h1 id="pagetitle"><?php echo Yii::t('t','What have you watched') ?></h1>
<div class="container main" id="page">			


<div class="filmslist_wrapper">
<?php
 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'filmslist',
	'dataProvider'=>$model->filmlist(),
	'filter'=>$model,
	'selectableRows' => 0,
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
		'value'=>'$data->getStar()',
		'sortable' => true,
		'htmlOptions'=>array('width'=>'5%'),
		'filter'=>array('1'=>'Only Favorite'),
		),
	
	),
)); 
?>
</div>
<script>
function changeStar(filmid){
	$('.items selected').removeClass('selected');
	$.post( "films/favorite", { filmid: filmid})
	.done(function( data ) { 
		$.fn.yiiGridView.update('filmslist'); 
	});
}
</script>
</div>