<div class="userEthnicityPreferences form">
<?php echo $this->Form->create('UserEthnicityPreference'); ?>
	<fieldset>
		<legend><?php echo __('Add User Ethnicity Preference'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('ethnicity_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List User Ethnicity Preferences'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ethnicities'), array('controller' => 'ethnicities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ethnicity'), array('controller' => 'ethnicities', 'action' => 'add')); ?> </li>
	</ul>
</div>
