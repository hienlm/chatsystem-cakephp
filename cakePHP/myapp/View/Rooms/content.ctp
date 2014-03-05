<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
    function showEditForm(id) {
        $('form#' + id).show();
    }
    function hideEditForm(id) {
        $('form#' + id).hide();
    }
</script>
<?php
// room list
foreach($roomlist as $roomname)
	{
		echo $this->Html->link($roomname['Room']['roomname'],
			array(
					'controller'=>'rooms',
					'action'=>'content',$roomname['Room']['roomID'])
		);
		echo '<br />';
	}
	//current room
 echo '<br/><br/>Roomname:'.$roomInfo['Room']['roomname'].' - Owner: '.$roomInfo['User']['username'].'<br />';
 echo $this->Session->flash('auth');?>
<div class = "user form">
<?php echo $this->Form->create('Message', array(
		'controller' 	=> 'messages', 
		'action'		=> 'add',
		'inputDefaults'		=> array (
			'label'		=> false,
			)
		)
	); ?>
    <fieldset>
        <?php echo $this->Form->input('content');
			 echo $this->Form->input('roomID',array(
						'type' => 'hidden',
						'label' => '',
						'value'=> $roomInfo['Room']['roomID']
						));					
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit'));  ?>
<div style="border : 2px solid; padding: 10px; margin: 10px">
<?php	
	//chat content
	foreach($content as $cont){
		echo $cont['User']['username'].": ";
		if($cont['Message']['status'] == 1) echo "*This is deleted*";
		else {
		echo $cont['Message']['content']. ' ';
		if($cont['Message']['status'] == 2) echo "*Edited at ".$cont['Message']['modified']."* ";
		if($cont['User']['userID'] == AuthComponent::user('userID')){
			//edit
                echo $this->Form->create('Message', array(
                    'inputDefaults' => array(
                        'label' => false,
                    ),
                    'url' => array(
                        'controller' => 'messages',
                        'action' => 'edit',
                        $cont['Message']['messageID']
                    ),
                    'style' => 'display:none',
                    'id' => $cont['Message']['messageID']
                ));
                echo $this->Form->input('content', 
										array('default' => $cont['Message']['content']));
				echo $this->Form->submit('Save');
				echo $this->Form->button('Cancel', 
										array('onclick' => 'hideEditForm(' 
											. $cont['Message']['messageID'] . ')', 
										'id' => 'btnCancel',
										'type' => 'button'));
                echo $this->Form->end();
			?><a href="#" onclick="showEditForm(<?php echo $cont['Message']['messageID'] ?>)">Edit</a>
			<?php
			//delete	
			echo $this->Html->link('Delete', array(
						'controller' => 'messages', 
						'action' => 'delete', 
						$cont['Message']['messageID']
						));?>
		
		<?php	}
		}
		echo '<br />';
	}
?>
	</div>
<?php	//end chat content
echo $this->Html->link('Logout', array('controller'=>'users','action'=>'logout'));	

?>
</div>