<?php 
	function printTableRow($obj, $drop, $active = true) {
		echo '<tr>';
		echo '<td>' . $obj->Html->link(h($drop['UserOne']['name']), array('controller' => 'users', 'action' => 'admin_view', $drop['UserOne']['facebook_token'])) . '<br/>' . $obj->Html->link(h($drop['UserTwo']['name']), array('controller' => 'users', 'action' => 'admin_view', $drop['UserTwo']['facebook_token'])) . '</td>';
		echo '<td>' . $obj->Html->link(h($drop['Bar']['name']), array('controller' => 'bars', 'action' => 'admin_view', $drop['Bar']['id'])) . '<br/>' . $drop['Bar']['address'] . '<br/>' . $drop['Bar']['city'] . '<br/>' . $drop['Bar']['postal_code'] . '</td>';
		echo '<td>' . date('m/d/y h:i A', strtotime($drop['Drop']['drop_date'])) . '</td>';
		echo '<td>' . date('m/d/y h:i A', strtotime($drop['Drop']['modified'])) . '</td>';
		
		echo '<td class="actions">';
		if ($active) {
			echo $obj->Html->link(
	    		$obj->Html->image('wrench.png', array('alt' => 'Edit')),
	    		array('action' => 'admin_edit', $drop['Drop']['id']),
	    		array('escape' => false, 'class' => 'left')
			);
		
			echo $obj->Form->postLink(
				$obj->Html->image('error.png', array('alt' => 'Delete')),
				array('action' => 'admin_delete', $drop['Drop']['id']),
				array('escape' => false, 'class' => 'right'),
				__('Are you sure you want to delete %s?', $drop['Drop']['drop_date'])
			);
		}
		else {
			echo $obj->Form->postLink(
				$obj->Html->image('magic_wand.png', array('alt' => 'Restore')),
				array('action' => 'admin_restore', $drop['Drop']['id']),
				array('escape' => false, 'class' => 'right'),
				__('Are you sure you want to restore %s?', $drop['Drop']['drop_date'])
			);
		}
		
		echo '</td>';
		echo '</tr>';
	}
?>
<script type='text/javascript'>
	$(document).ready(function() {
		$('.bars').accordion({
			heightStyle: "content"
		});
		
		$('.bars-table').dataTable();
	});
</script>
<a href="/admin/drops/add" class="add-item">[Add Drop]</a>
<div class="bars index">
	<h3>Upcoming - <?php echo count($dropsUpcoming); ?> Records</h3>
	<div>
  		<table class='bars-table'>
	  		<thead>
				<tr>
					<th>Users</th>
					<th>Bar</th>
					<th>Date</th>
					<th>Last Update</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				foreach ($dropsUpcoming as $drop): 
					//print_r($drop);
					printTableRow($this, $drop);
				endforeach; 
			?>
			</tbody>
		</table>
	</div>
	
	<h3>Past - <?php echo count($dropsPast); ?> Records</h3>
  	<div>
  		<table class='bars-table'>
	  		<thead>
				<tr>
					<th>Name</th>
					<th>Location</th>
					<th>Types</th>
					<th>Last Update</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				foreach ($dropsPast as $drop):  
					printTableRow($this, $drop, false);
				endforeach;	
			?>
			</tbody>
		</table>
  	</div>
</div>