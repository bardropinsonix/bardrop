<div class="userEthnicityPreferences view">
<h2><?php echo __('User Ethnicity Preference'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userEthnicityPreference['UserEthnicityPreference']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userEthnicityPreference['User']['name'], array('controller' => 'users', 'action' => 'view', $userEthnicityPreference['User']['facebook_token'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ethnicity'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userEthnicityPreference['Ethnicity']['ethnicity'], array('controller' => 'ethnicities', 'action' => 'view', $userEthnicityPreference['Ethnicity']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User Ethnicity Preference'), array('action' => 'edit', $userEthnicityPreference['UserEthnicityPreference']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User Ethnicity Preference'), array('action' => 'delete', $userEthnicityPreference['UserEthnicityPreference']['id']), null, __('Are you sure you want to delete # %s?', $userEthnicityPreference['UserEthnicityPreference']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List User Ethnicity Preferences'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Ethnicity Preference'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ethnicities'), array('controller' => 'ethnicities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ethnicity'), array('controller' => 'ethnicities', 'action' => 'add')); ?> </li>
	</ul>
</div>
