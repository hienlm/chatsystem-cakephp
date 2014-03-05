<pre>
	<?php 
	// var_dump($roomlist);die;?>
</pre>

<?php
	echo $this->Html->link('Create a new room', array('controller'=>'rooms','action'=>'addroom'));
	echo '<br /> <br />';
	// display room list
	echo 'Room list: <br />';

	foreach($roomlist as $roomname)
		{
			echo $this->Html->link($roomname['Room']['roomname'],
				array(
					'controller'=>'rooms',
					'action'=>'content',$roomname['Room']['roomID'])
			);
			echo '<br />';
		}
	echo $this->Html->link('Logout', array('controller'=>'users','action'=>'logout'));
?>