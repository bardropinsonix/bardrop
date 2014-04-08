<div class="userReligionPreferences view">
<h2><?php echo __('User Religion Preference'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userReligionPreference['UserReligionPreference']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userReligionPreference['User']['name'], array('controller' => 'users', 'action' => 'view', $userReligionPreference['User']['facebook_token'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Religion'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userReligionPreference['Religion']['religion'], array('controller' => 'religions', 'action' => 'view', $userReligionPreference['Religion']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User Religion Preference'), array('action' => 'edit', $userReligionPreference['UserReligionPreference']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User Religion Preference'), array('action' => 'delete', $userReligionPreference['UserReligionPreference']['id']), null, __('Are you sure you want to delete # %s?', $userReligionPreference['UserReligionPreference']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List User Religion Preferences'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Religion Preference'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Religions'), array('controller' => 'religions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Religion'), array('controller' => 'religions', 'action' => 'add')); ?> </li>
	</ul>
</div>
