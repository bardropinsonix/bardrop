<div class="userEthnicityPreferences form">
<?php echo $this->Form->create('UserEthnicityPreference'); ?>
	<fieldset>
		<legend><?php echo __('Edit User Ethnicity Preference'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('ethnicity_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('UserEthnicityPreference.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('UserEthnicityPreference.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List User Ethnicity Preferences'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ethnicities'), array('controller' => 'ethnicities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ethnicity'), array('controller' => 'ethnicities', 'action' => 'add')); ?> </li>
	</ul>
</div>
