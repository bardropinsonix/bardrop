<div class="userEthnicityPreferences index">
	<h2><?php echo __('User Ethnicity Preferences'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('ethnicity_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($userEthnicityPreferences as $userEthnicityPreference): ?>
	<tr>
		<td><?php echo h($userEthnicityPreference['UserEthnicityPreference']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($userEthnicityPreference['User']['name'], array('controller' => 'users', 'action' => 'view', $userEthnicityPreference['User']['facebook_token'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($userEthnicityPreference['Ethnicity']['ethnicity'], array('controller' => 'ethnicities', 'action' => 'view', $userEthnicityPreference['Ethnicity']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $userEthnicityPreference['UserEthnicityPreference']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $userEthnicityPreference['UserEthnicityPreference']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $userEthnicityPreference['UserEthnicityPreference']['id']), null, __('Are you sure you want to delete # %s?', $userEthnicityPreference['UserEthnicityPreference']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New User Ethnicity Preference'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ethnicities'), array('controller' => 'ethnicities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ethnicity'), array('controller' => 'ethnicities', 'action' => 'add')); ?> </li>
	</ul>
</div>
