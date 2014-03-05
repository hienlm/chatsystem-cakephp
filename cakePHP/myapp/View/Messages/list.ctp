<?php 
	foreach($content as $cont){
		echo $cont['User']['username'].": ";
		if($cont['Message']['status']==1) echo "*This is deleted*";
		else {
		echo $cont['Message']['content']. ' ';
		if($cont['Message']['status']==2) echo "*Edited at ".$cont['Message']['modified']."* ";
		if($cont['User']['userID'] == AuthComponent::user('userID')){
			//edit
                echo $this->Form->create('Message', array(
                    'inputDefaults' => array(
                        'label' => false
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
						));
			}
		}
		echo '<br />';
	}
?>