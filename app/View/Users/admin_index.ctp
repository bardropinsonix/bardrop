<?php 
	function printTableRow($obj, $user, $active = true) {
		echo '<tr>';
		echo '<td>' . $obj->Html->link(h($user['User']['name']), array('action' => 'admin_data', $user['User']['facebook_token'])) . '</td>';
		echo '<td>' . h($user['User']['email_address']) . '</td>';
		//echo '<td>' . $user['User']['city'] . '<br/>' . $user['State']['state'] . '<br/>' . $user['Country']['country'] . '</td>';
		echo '<td>' . date('m/d/y h:i A', strtotime($user['User']['modified'])) . '</td>';
		
		echo '<td class="actions">';
		if ($active) {
			echo $obj->Html->link(
	    		$obj->Html->image('wrench.png', array('alt' => 'Edit')),
	    		array('action' => 'admin_profile', $user['User']['facebook_token']),
	    		array('escape' => false, 'class' => 'left')
			);
		
			echo $obj->Form->postLink(
				$obj->Html->image('error.png', array('alt' => 'Delete')),
				array('action' => 'admin_delete', $user['User']['facebook_token']),
				array('escape' => false, 'class' => 'right'),
				__('Are you sure you want to delete %s?', $user['User']['name'])
			);
		}
		else {
			echo $obj->Form->postLink(
				$obj->Html->image('magic_wand.png', array('alt' => 'Restore')),
				array('action' => 'admin_restore', $user['User']['facebook_token']),
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
		$('.users').accordion({
			heightStyle: "content",
			active: 1 
		});
		
		$('.users-table').dataTable();
	});
</script>
<div class='users index'>
	<h3>New Users - Needs to complete profile - <?php echo $usersActiveCount[PHASE_0]; ?> Records</h3>
  	<div>
  		<table class='users-table'>
			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<!-- <th>Location</th> -->
					<th>Last Update</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				foreach ($usersActive as $user): 
					if (PHASE_0 == $user['User']['user_phase_id']) 
						printTableRow($this, $user);
				endforeach;	
			?>
			</tbody>
		</table>
  	</div>
  	
	<h3>Phase 1 - Profile complete, need admin approval - <?php echo $usersActiveCount[PHASE_1]; ?> Records</h3>
  	<div>
  		<table class='users-table'>
			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<!-- <th>Location</th> -->
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
  	
	<h3>Phase 2 - Profile approved, LFMatch - <?php echo $usersActiveCount[PHASE_2]; ?> Records</h3>
  	<div>
  		<table class='users-table'>
			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<!-- <th>Location</th> -->
					<th>Last Update</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				foreach ($usersActive as $user): 
					if (PHASE_2 == $user['User']['user_phase_id']) 
						printTableRow($this, $user);
				endforeach;	
			?>
			</tbody>
		</table>
  	</div>
  	
	<h3>Phase 3 - Match found, allow schedule reserve - <?php echo $usersActiveCount[PHASE_3]; ?> Records</h3>
  	<div>
  		<table class='users-table'>
			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<!-- <th>Location</th> -->
					<th>Last Update</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				foreach ($usersActive as $user): 
					if (PHASE_3 == $user['User']['user_phase_id']) 
						printTableRow($this, $user);
				endforeach;	
			?>
			</tbody>
		</table>
  	</div>
  	
	<h3>Phase 4 - Reserve complete, need admin approval <?php echo $usersActiveCount[PHASE_4]; ?> Records</h3>
  	<div>
  		<table class='users-table'>
			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<!-- <th>Location</th> -->
					<th>Last Update</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				foreach ($usersActive as $user): 
					if (PHASE_4 == $user['User']['user_phase_id']) 
						printTableRow($this, $user);
				endforeach;	
			?>
			</tbody>
		</table>
  	</div>	
  	
	<h3>Phase 5 - BarDrop reserve approved and set <?php echo $usersActiveCount[PHASE_5]; ?> Records</h3>
  	<div>
  		<table class='users-table'>
			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<!-- <th>Location</th> -->
					<th>Last Update</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				foreach ($usersActive as $user): 
					if (PHASE_5 == $user['User']['user_phase_id']) 
						printTableRow($this, $user);
				endforeach;	
			?>
			</tbody>
		</table>
  	</div>	
  	
	<h3>Inactive - <?php echo count($usersInactive); ?> Records</h3>
  	<div>
  		<table class='users-table'>
			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<!-- <th>Location</th> -->
					<th>Last Update</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				foreach ($usersInactive as $user):  
					printTableRow($this, $user, false);
				endforeach;	
			?>
			</tbody>
		</table>
  	</div>	
</div>