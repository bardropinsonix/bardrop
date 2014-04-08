<div class="userBars form">
<?php echo $this->Form->create('UserBar'); ?>
	<fieldset>
		<legend><?php echo __('Add User Bar'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('bar_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List User Bars'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Bars'), array('controller' => 'bars', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bar'), array('controller' => 'bars', 'action' => 'add')); ?> </li>
	</ul>
</div>
