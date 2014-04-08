<div class="bars view">
<h2><?php echo __('Bar'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($bar['Bar']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($bar['Bar']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($bar['Bar']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo h($bar['Bar']['city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo h($bar['Bar']['state']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Postal Code'); ?></dt>
		<dd>
			<?php echo h($bar['Bar']['postal_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($bar['Bar']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($bar['Bar']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($bar['Bar']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Bar'), array('action' => 'edit', $bar['Bar']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Bar'), array('action' => 'delete', $bar['Bar']['id']), null, __('Are you sure you want to delete # %s?', $bar['Bar']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Bars'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bar'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Bar Types'), array('controller' => 'bar_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bar Type'), array('controller' => 'bar_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Drops'), array('controller' => 'drops', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Drop'), array('controller' => 'drops', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Drops'); ?></h3>
	<?php if (!empty($bar['Drop'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User One Id'); ?></th>
		<th><?php echo __('User Two Id'); ?></th>
		<th><?php echo __('Bar Id'); ?></th>
		<th><?php echo __('Date'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Created By'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Modified By'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($bar['Drop'] as $drop): ?>
		<tr>
			<td><?php echo $drop['id']; ?></td>
			<td><?php echo $drop['user_one_id']; ?></td>
			<td><?php echo $drop['user_two_id']; ?></td>
			<td><?php echo $drop['bar_id']; ?></td>
			<td><?php echo $drop['date']; ?></td>
			<td><?php echo $drop['created']; ?></td>
			<td><?php echo $drop['created_by']; ?></td>
			<td><?php echo $drop['modified']; ?></td>
			<td><?php echo $drop['modified_by']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'drops', 'action' => 'view', $drop['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'drops', 'action' => 'edit', $drop['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'drops', 'action' => 'delete', $drop['id']), null, __('Are you sure you want to delete # %s?', $drop['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Drop'), array('controller' => 'drops', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
