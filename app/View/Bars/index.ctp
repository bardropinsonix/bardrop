<div class="bars index">
	<h2><?php echo __('Bars'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('address'); ?></th>
			<th><?php echo $this->Paginator->sort('city'); ?></th>
			<th><?php echo $this->Paginator->sort('state'); ?></th>
			<th><?php echo $this->Paginator->sort('postal_code'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($bars as $bar): ?>
	<tr>
		<td><?php echo h($bar['Bar']['id']); ?>&nbsp;</td>
		<td><?php echo h($bar['Bar']['name']); ?>&nbsp;</td>
		<td><?php echo h($bar['Bar']['address']); ?>&nbsp;</td>
		<td><?php echo h($bar['Bar']['city']); ?>&nbsp;</td>
		<td><?php echo h($bar['Bar']['state']); ?>&nbsp;</td>
		<td><?php echo h($bar['Bar']['postal_code']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($bar['BarType']['bar_type'], array('controller' => 'bar_types', 'action' => 'view', $bar['BarType']['id'])); ?>
		</td>
		<td><?php echo h($bar['Bar']['status']); ?>&nbsp;</td>
		<td><?php echo h($bar['Bar']['created']); ?>&nbsp;</td>
		<td><?php echo h($bar['Bar']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $bar['Bar']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $bar['Bar']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $bar['Bar']['id']), null, __('Are you sure you want to delete # %s?', $bar['Bar']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Bar'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Bar Types'), array('controller' => 'bar_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bar Type'), array('controller' => 'bar_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Drops'), array('controller' => 'drops', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Drop'), array('controller' => 'drops', 'action' => 'add')); ?> </li>
	</ul>
</div>
