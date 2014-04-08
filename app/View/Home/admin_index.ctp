<?php 
	function printTableRow($obj, $user, $active = true) {
		echo '<tr>';
		echo '<td>' . $obj->Html->link(h($user['User']['name']), array('controller' => 'users', 'action' => 'admin_data', $user['User']['facebook_token'])) . '</td>';
		echo '<td>' . h($user['User']['email_address']) . '</td>';
		echo '<td>' . $user['User']['city'] . '<br/>' . $user['State']['state'] . '<br/>' . $user['Country']['country'] . '</td>';
		echo '<td>' . date('m/d/y h:i A', strtotime($user['User']['modified'])) . '</td>';
		
		echo '<td class="actions">';
		echo $obj->Html->link(
    		$obj->Html->image('wrench.png', array('alt' => 'Edit')),
    		array('controller' => 'users', 'action' => 'admin_edit', $user['User']['facebook_token']),
    		array('escape' => false, 'class' => 'left')
		);
		
		if ($active) {
			echo $obj->Form->postLink(
				$obj->Html->image('error.png', array('alt' => 'Delete')),
				array('controller' => 'users', 'action' => 'admin_delete', $user['User']['facebook_token']),
				array('escape' => false, 'class' => 'right'),
				__('Are you sure you want to delete %s?', $user['User']['name'])
			);
		}
		else {
			echo $obj->Form->postLink(
				$obj->Html->image('magic_wand.png', array('alt' => 'Restore')),
				array('controller' => 'users', 'action' => 'admin_restore', $user['User']['facebook_token']),
				array('escape' => false, 'class' => 'right'),
				__('Are you sure you want to restore %s?', $user['User']['name'])
			);
		}
		
		echo '</td>';
		echo '</tr>';
	}

	$usersActiveCount = array();
	$usersActiveCount[PHASE_0] = 0;
	$usersActiveCount[PHASE_1] = 0;
	$usersActiveCount[PHASE_2] = 0;
	$usersActiveCount[PHASE_3] = 0;
	$usersActiveCount[PHASE_4] = 0;
	$usersActiveCount[PHASE_5] = 0;
	
	foreach ($usersActive as $user) {
		switch ($user['User']['user_phase_id']){
			case PHASE_0:
				$usersActiveCount[PHASE_0]++;
				break;
			case PHASE_1:
				$usersActiveCount[PHASE_1]++;
				break;
			case PHASE_2:
				$usersActiveCount[PHASE_2]++;
				break;
			case PHASE_3:
				$usersActiveCount[PHASE_3]++;
				break;
			case PHASE_4:
				$usersActiveCount[PHASE_4]++;
				break;
			case PHASE_5:
				$usersActiveCount[PHASE_5]++;
				break;
		}
	}
?>

<script type='text/javascript'>
	$(document).ready(function() {
		$('.home').accordion({
			heightStyle: "content"
		});
		
		$('.home-table').dataTable();

		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev, next today',
				center: 'title',
				right: 'month, agendaWeek, agendaDay'
			},
			editable: true,
			events: [
				<?php foreach ($drops as $drop): ?>
				{
					title: '<?php echo $drop['Bar']['name']; ?>',
					start: '<?php echo $drop['Drop']['drop_date']; ?>',
					url: '/admin/drops/view/<?php echo $drop['Drop']['id']; ?>' 
				},
				<?php endforeach; ?>
			]
		});
	});
</script>
<div class='home index'>
	<h3>Snapshot</h3>
  	<div>
  		<div id='calendar'></div>
  		<div id='glance'>
	  		<p>New Users - <?php echo $usersActiveCount[PHASE_0]; ?> Records</p>
	  		<p>Phase 1 - <?php echo $usersActiveCount[PHASE_1]; ?> Records</p>
	  		<p>Phase 2 - <?php echo $usersActiveCount[PHASE_2]; ?> Records</p>
	  		<p>Phase 3 - <?php echo $usersActiveCount[PHASE_3]; ?> Records</p>
	  		<p>Phase 4 - <?php echo $usersActiveCount[PHASE_4]; ?> Records</p>
	  		<p>Phase 5 - <?php echo $usersActiveCount[PHASE_5]; ?> Records</p>
	  	</div>
  	</div>	
  	
	<h3>Review - <?php echo $usersActiveCount[PHASE_1]; ?> Records</h3>
  	<div>
  		<table class='home-table'>
			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Location</th>
					<th>Last Update</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				foreach ($usersActive as $user): 
					if (PHASE_1 == $user['User']['user_phase_id']) 
						printTableRow($this, $user);
				endforeach;	
			?>
			</tbody>
		</table>
  	</div>
  	
	<h3>Match - <?php echo $usersActiveCount[PHASE_3]; ?> Records</h3>
  	<div>
  		<table class='home-table'>
			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Location</th>
					<th>Last Update</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				foreach ($usersActive as $user): 
					if (PHASE_1 == $user['User']['user_phase_id']) 
						printTableRow($this, $user);
				endforeach;	
			?>
			</tbody>
		</table>
  	</div>
  	
	<h3>Reschedule - ??? Records</h3>
  	<div>
  		<table class='home-table'>
			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Location</th>
					<th>Last Update</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
			
			</tbody>
		</table>
  	</div>
</div>