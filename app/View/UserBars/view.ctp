<div class="userBars view">
<h2><?php echo __('User Bar'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userBar['UserBar']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userBar['User']['name'], array('controller' => 'users', 'action' => 'view', $userBar['User']['facebook_token'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bar'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userBar['Bar']['name'], array('controller' => 'bars', 'action' => 'view', $userBar['Bar']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User Bar'), array('action' => 'edit', $userBar['UserBar']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User Bar'), array('action' => 'delete', $userBar['UserBar']['id']), null, __('Are you sure you want to delete # %s?', $userBar['UserBar']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List User Bars'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Bar'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Bars'), array('controller' => 'bars', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bar'), array('controller' => 'bars', 'action' => 'add')); ?> </li>
	</ul>
</div>
