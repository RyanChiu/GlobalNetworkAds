<?php 
$userinfo = $this->Session->read('Auth.User.Account');
?>

<div class="table-responsive">
<div>
<?php
if (in_array($userinfo['id'], array(1,2))) {
	echo $this->Form->button('ADD ADMIN...',
		array(
			'onclick' => 'javascript:location.href=\''
				. $this->Html->url(array('controller' => 'accounts', 'action' => 'regadmin')) . '\'',
			'class' => 'btn btn-link font-weight-bold text-danger'
		)
	);
}
?>
</div>
<table class="table-sm w-100">
<thead class="totals">
<tr class="text-black">
	<th><b><?php echo $this->ExPaginator->sort('ViewAdmin.username', 'Username', array('class' => 'text-reset')); ?></b></th>
	<th><b><?php echo $this->ExPaginator->sort('ViewAdmin.originalpwd', 'Password', array('class' => 'text-reset')); ?></b></th>
	<th><b><?php echo $this->ExPaginator->sort('ViewAdmin.email', 'Email', array('class' => 'text-reset')); ?></b></th>
	<th><b><?php echo $this->ExPaginator->sort('ViewAdmin.regtime', 'Registered', array('class' => 'text-reset')); ?></b></th>
	<th><b><?php echo $this->ExPaginator->sort('ViewAdmin.level', 'Earnings', array('class' => 'text-reset')); ?></b></th>
	<th><b><?php echo $this->ExPaginator->sort('ViewAdmin.status', 'Status', array('class' => 'text-reset')); ?></b></th>
	<th><b>Modify</b></th>
</tr>
</thead>
<?php
$i = 0;
foreach ($rs as $r):
	if (!in_array($r['ViewAdmin']['id'], array(1,2))) {
?>
<tr <?php echo $i % 2 == 0 ? '' : 'class="odd"'; ?>>
	<td><?php echo $r['ViewAdmin']['username']; ?></td>
	<td><?php echo $r['ViewAdmin']['originalpwd']; ?></td>
	<td><?php echo $r['ViewAdmin']['email']; ?></td>
	<td><?php echo $r['ViewAdmin']['regtime']; ?></td>
	<td><?php echo $r['ViewAdmin']['level'] == 1 ? 'visible' : 'invisible'; ?></td>
	<td><?php echo $status[$r['ViewAdmin']['status']]; ?></td>
	<td align="center">
		<?php
		echo $this->Html->link(
			$this->Html->image('iconEdit.png', array('border' => 0, 'width' => 16, 'height' => 16)) . '&nbsp;',
			array('controller' => 'accounts', 'action' => 'updadmin', 'id' => $r['ViewAdmin']['id']),
			array('title' => 'Click to edit this record.', 'escape' => false),
			false
		);
		?>
	</td>
</tr>
<?php
	$i++;
	}
endforeach;
?>
</table>
</div>