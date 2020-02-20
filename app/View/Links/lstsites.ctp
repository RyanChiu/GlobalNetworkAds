<?php
$userinfo = $this->Session->read('Auth.User.Account');
?>
<table class="table table-sm table-borderless w-100 mb-1">
	<tr><td>
	<?php
	echo $this->Form->button('Add Site...',
		array(
			'onclick' => 'javascript:location.href=\''
				. $this->Html->url(array('controller' => 'links', 'action' => 'addsite')) . '\'',
			'class' => 'btn btn-link float-left p-0'
		)
	);
	?>
	</td></tr>
</table>
<div class="table-responsive">
<table class="table-sm table-striped w-100">
	<thead class="bg-warning">
	<tr class="text-black">
		<th><?php echo $this->ExPaginator->sort('ViewSite.hostname', 'Campaigns', array('class' => 'text-reset')) . '<br/><font size="1">(for admin only)</font>'; ?></th>
		<th><?php echo $this->ExPaginator->sort('ViewSite.sitename', 'Site Name', array('class' => 'text-reset')) . '<br/><font size="1">(for team or seller)</font>'; ?></th>
		<th><?php echo $this->ExPaginator->sort('ViewSite.type', 'Site Type', array('class' => 'text-reset')); ?></th>
		<?php
		if ($userinfo['id'] == 2) {
		?>
		<th><?php echo $this->ExPaginator->sort('ViewSite.abbr', 'Abbreviation', array('class' => 'text-reset')) . '<br/><font size="1">(for admin only)</font>'; ?></th>
		<?php
		}
		?>
		<th><?php echo $this->ExPaginator->sort('ViewSite.typestotal', 'Sale Types', array('class' => 'text-reset')); ?></th>
		<th><?php echo $this->ExPaginator->sort('ViewSite.status', 'Status', array('class' => 'text-reset')); ?></th>
		<th>Change</th>
	</tr>
	</thead>
	<?php
	foreach ($rs as $r) :
	?>
	<tr>
		<td><?php echo $r['ViewSite']['hostname'];	?></td>
		<td><?php echo $r['ViewSite']['sitename'];	?></td>
		<td><?php echo $r['ViewSite']['type'];	?></td>
		<?php
		if ($userinfo['id'] == 2) {
		?>
		<td><?php echo $r['ViewSite']['abbr'];	?></td>
		<?php
		}
		?>
		<td>
		<?php
		echo $this->Html->link(
			$r['ViewSite']['typestotal'] . '&nbsp;' . $this->Html->image('iconList.gif', array('border' => 0)),
			array('controller' => 'links', 'action' => 'lsttypes', 'id' => $r['ViewSite']['id']),
			array('title' => 'Click to view the types of the site.', 'escape' => false),
			false
		);
		?>
		</td>
		<td>
		<?php
		echo in_array($r['ViewSite']['status'], array(0, 1)) ? $status[$r['ViewSite']['status']] : $status[0];
		?>
		</td>
		<td align="center">
		<?php
		echo $this->Html->link(
			$this->Html->image('iconEdit.png', array('border' => 0, 'width' => 16, 'height' => 16)) . '&nbsp;',
			array('controller' => 'links', 'action' => 'updsite', 'id' => $r['ViewSite']['id']),
			array('title' => 'Click to edit this site.', 'escape' => false),
			false
		);
		echo $this->Html->link(
			$this->Html->image('iconActivate.png', array('border' => 0, 'width' => 16, 'height' => 16)) . '&nbsp;',
			array('controller' => 'links', 'action' => 'activatesite', 'id' => $r['ViewSite']['id']),
			array('title' => 'Click to activate the site.', 'escape' => false),
			false
		);
		echo $this->Html->link(
			$this->Html->image('iconSuspend.png', array('border' => 0, 'width' => 16, 'height' => 16)) . '&nbsp;',
			array('controller' => 'links', 'action' => 'suspendsite', 'id' => $r['ViewSite']['id']),
			array('title' => 'Click to suspend the site.', 'escape' => false),
			false
		);
		?>
		</td>
	</tr>
	<?php
	endforeach;
	?>
</table>
</div>
