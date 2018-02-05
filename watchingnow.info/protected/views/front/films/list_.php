
<div id="list">
<ul id="films_list">
<?php	  foreach($list as $film){
echo '<li class="ui-state-default" id="item_'.$film->id.'">';
echo '<div>'.$film->name.'</div>&nbsp;&nbsp;<span class=" pointer" onclick="Delete('.$film->id.')">'.Yii::t('t','delete').'</span><br />';
echo '</li>';

} ?>
</ul>
</div>
<div id="test"></div>
<script type="text/javascript">
// $(function() {
//$( "#films_list" ).sortable({
  
 //     update: function(event, ui){
  //   var data1=$(this).sortable("serialize");
	
    //         $.ajax({
     //           url: "order",
       //         type: 'POST',
         //       data: {
           //          'order': data1
             //   }

             //});
                       
   // }
//});

//});
</script>