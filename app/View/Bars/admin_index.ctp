<?php 
	function printTableRow($obj, $bar, $active = true) {
		echo '<tr>';
		echo '<td>' . $obj->Html->link(h($bar['Bar']['name']), array('action' => 'admin_view', $bar['Bar']['id'])) . '</td>';
		echo '<td>' . $bar['Bar']['address'] . '<br/>' . $bar['Bar']['city'] . '<br/>' . $bar['State']['state'] . '<br/>' . $bar['Country']['country'] . '<br/>' . $bar['Bar']['postal_code'] . '</td>';
		echo '<td>';
		
		foreach ($bar['BarType'] as $barType){
			echo $barType['bar_type'] . '<br/>';
		}
		
		echo '</td>';
		echo '<td>' . date('m/d/y h:i A', strtotime($bar['Bar']['modified'])) . '</td>';
		
		echo '<td class="actions">';
		if ($active) {
			echo $obj->Html->link(
	    		$obj->Html->image('wrench.png', array('alt' => 'Edit')),
	    		array('action' => 'admin_edit', $bar['Bar']['id']),
	    		array('escape' => false, 'class' => 'left')
			);
		
			echo $obj->Form->postLink(
				$obj->Html->image('error.png', array('alt' => 'Delete')),
				array('action' => 'admin_delete', $bar['Bar']['id']),
				array('escape' => false, 'class' => 'right'),
				__('Are you sure you want to delete %s?', $bar['Bar']['name'])
			);
		}
		else {
			echo $obj->Form->postLink(
				$obj->Html->image('magic_wand.png', array('alt' => 'Restore')),
				array('action' => 'admin_restore', $bar['Bar']['id']),
				array('escape' => false, 'class' => 'right'),
				__('Are you sure you want to restore %s?', $bar['Bar']['name'])
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
<a href="/admin/bars/add" class="add-item">[Add Bar]</a>
<div class="bars index">
	<h3>Active - <?php echo count($barsActive); ?> Records</h3>
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
				foreach ($barsActive as $bar): 
					printTableRow($this, $bar);
				endforeach; 
			?>
			</tbody>
		</table>
	</div>
	
	<h3>Inactive - <?php echo count($barsInactive); ?> Records</h3>
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
				foreach ($barsInactive as $bar):  
					printTableRow($this, $bar, false);
				endforeach;	
			?>
			</tbody>
		</table>
  	</div>
</div>