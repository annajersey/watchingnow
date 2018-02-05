
	
	
	<div id="intro">
		<div id="header">
<div class="float-right">
<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				
				array('label'=>Yii::t('t','Sign In'), 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>Yii::t('t','Sign Up'), 'url'=>array('/userinfo/register'), 'visible'=>Yii::app()->user->isGuest),
				
				
			),
		)); ?>
</div>
</div>	
		<div class="story">
	    	<div class="float-right">
				<h1><?php echo Yii::t('t','What movie are you watching now?'); ?></h1>
	        </div>
	    </div> <!--.story-->
	</div> <!--#intro-->
	<div id="first_text">
		<div class="story">
		<?php echo Yii::t('t','Share with your friends!'); ?>
		</div>
	</div>
	<div id="second">
	</div> <!--#second-->
	<div id="second_text">
		<div class="story">
		
			<ul>
				<li><?php echo Yii::t('t','Create nice and simple watchlists'); ?></li>
				<li><?php echo Yii::t('t','Make future plans'); ?></li>
				<li><?php echo Yii::t('t','Check previous watchings'); ?></li>
				<li><?php echo Yii::t('t','Find out what friends are currently watching'); ?></li>
			</ul>
		
		</div>
	</div>
	
	
	<div id="third_text">
		
	</div>
	
	<script type="text/javascript">
$(document).ready(function(){
	
	
	//.parallax(xPosition, speedFactor, outerHeight) options:
	//xPosition - Horizontal position of the element
	//inertia - speed to move relative to vertical scroll. Example: 0.1 is one tenth the speed of scrolling, 2 is twice the speed of scrolling
	//outerHeight (true/false) - Whether or not jQuery should use it's outerHeight option to determine when a section is in the viewport
	$('#intro').parallax("50%", 0.1);
	$('#second').parallax("100%", 0.1);
	//$('.bg').parallax("50%", 0.4);
	$('#third').parallax("100%", 0.3);
	
})
</script>