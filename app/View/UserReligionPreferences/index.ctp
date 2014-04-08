<div class="userReligionPreferences index">
	<h2><?php echo __('User Religion Preferences'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('religion_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($userReligionPreferences as $userReligionPreference): ?>
	<tr>
		<td><?php echo h($userReligionPreference['UserReligionPreference']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($userReligionPreference['User']['name'], array('controller' => 'users', 'action' => 'view', $userReligionPreference['User']['facebook_token'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($userReligionPreference['Religion']['religion'], array('controller' => 'religions', 'action' => 'view', $userReligionPreference['Religion']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $userReligionPreference['UserReligionPreference']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $userReligionPreference['UserReligionPreference']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $userReligionPreference['UserReligionPreference']['id']), null, __('Are you sure you want to delete # %s?', $userReligionPreference['UserReligionPreference']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New User Religion Preference'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Religions'), array('controller' => 'religions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Religion'), array('controller' => 'religions', 'action' => 'add')); ?> </li>
	</ul>
</div>
