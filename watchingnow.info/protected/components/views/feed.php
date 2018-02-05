  
	<div class="content">
	<h2><?php echo Yii::t('t','Latest watchings'); ?></h2>
    <?php 
	
     foreach($feedlist as $film) {?>
        <div class="feed_item">
		<div class="feed_item_top">
		<div class="feed_item_username"><a href="<?php echo Yii::app()->baseUrl; ?>/userlist/<?php echo $film->getusername(); ?>"><?php echo $film->getusername(); ?></a></div>
		<div class="feed_item_date"><?php echo date('d-m-Y H:i',$film->timestamp); ?></div>
		</div>
		<div class="feed_title"><?php echo $film->name; ?><?php echo $film->getStar(false); ?></div>
		</div>
     <?php } ?>
	 </div>
