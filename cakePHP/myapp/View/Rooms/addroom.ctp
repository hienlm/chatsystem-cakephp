<div>
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('Room'); ?>
    <fieldset>
        <legend>
            <?php echo __('Please enter your roomname'); 
			?>
        </legend>
		<?php echo $this->Form->input('roomname');
		?>
    </fieldset>
<?php 	echo $this->Form->end(__('Create')); 
		echo $this->Html->link('Logout', array('controller'=>'users','action'=>'logout')); ?>
</div>