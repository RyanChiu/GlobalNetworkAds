<?php
$userinfo = $this->Session->read('Auth.User.Account');
?>
<br/>

<?php
/*showing the results*/
?>
<script type="text/javascript">
function __setActSusLink() {
	var checkboxes;
	checkboxes = document.getElementsByName("data[ViewNewMember][selected]");
	var ids = "";
	for (var i = 0; i < checkboxes.length; i++) {
		if (checkboxes[i].checked && checkboxes[i].value != 0) {
			ids += checkboxes[i].value + ",";
		}
	}
	document.getElementById("linkActivateSelected").href =
		document.getElementById("linkActivateSelected_").href + "/ids:" + ids + "/status:1/from:2";
}
function __checkAll() {
	var checkboxes;
	checkboxes = document.getElementsByName("data[ViewNewMember][selected]");
	for (var i = 0; i < checkboxes.length; i++) {
		checkboxes[i].checked = document.getElementById("checkboxAll").checked;
	}
}
</script>

<div class="table-responsive">
<table class="table-sm w-100">
<thead class="bg-warning">
<tr class="text-black">
	<th><b>
	<?php
	echo $this->Form->checkbox('',
		array('id' => 'checkboxAll', 'value' => -1,
			'style' => 'border:0px;width:16px;',
			'onclick' => 'javascript:__checkAll();__setActSusLink();'
		)
	);
	?>
	</b></th>
	<th><b><?php echo $this->ExPaginator->sort('ViewNewMember.username4m', 'User', array('class' => 'text-reset')); ?></b></th>
	<th><b><?php echo $this->ExPaginator->sort('ViewNewMember.officename', 'Team', array('class' => 'text-reset')); ?></b></th>
	<th><b><?php echo $this->ExPaginator->sort('ViewNewMember.role', 'Role', array('class' => 'text-reset')); ?></b></th>
	<th><b><?php echo $this->ExPaginator->sort('ViewNewMember.regtime', 'Registered', array('class' => 'text-reset')); ?></b></th>
	<th><b><?php echo $this->ExPaginator->sort('ViewNewMember.status', 'Status', array('class' => 'text-reset')); ?></b></th>
	<th><b>Allow</b></th>
</tr>
</thead>
<?php
$i = 0;
foreach ($rs as $r):
?>
<tr <?php echo $i % 2 == 0? '' : 'class="odd"'; ?>>
	<td>
	<?php
	echo $this->Form->checkbox('ViewNewMember.selected',
		array('value' => $r['ViewNewMember']['id'],
			'style' => 'border:0px;width:16px;',
			'onclick' => 'javascript:__setActSusLink();'
		)
	);
	echo '<font size="1">' . ($i + 1 + $limit * ($this->Paginator->current() - 1)) . '</font>';
	?>
	</td>
	<td><?php echo $r['ViewNewMember']['username']; ?></td>
	<td><?php echo $r['ViewNewMember']['officename']; ?></td>
	<td><?php echo $r['ViewNewMember']['role'] == 1 ? "Team Manager" : "Seller"; ?></td>
	<td><?php echo $r['ViewNewMember']['regtime']; ?></td>
	<td><?php echo $status[$r['ViewNewMember']['status']]; ?></td>
	<td align="center">
	<?php
	echo $this->Html->link(
		$this->Html->image('iconActivate.png', array('border' => 0, 'width' => 16, 'height' => 16)) . '&nbsp;',
		array('controller' => 'accounts', 'action' => 'activatem', 'ids' => $r['ViewNewMember']['id'], 'status' => 1, 'from' => 2),
		array('title' => 'Click to approve the account.', 'escape' => false),
		false
	);
	?>
	</td>
</tr>
<?php
$i++;
endforeach;
?>
</table>
</div>

<div style="margin-top:3px;">
<font color="green">With selected :&nbsp;</font>
<?php
/*activate selected*/
echo $this->Html->link(
	$this->Html->image('iconActivate.png', array('border' => 0, 'width' => 16, 'height' => 16)) . '&nbsp;&nbsp;',
	array('controller' => 'accounts', 'action' => 'activatem'),
	array('id' => 'linkActivateSelected', 'title' => 'Click to approve the selected accounts.', 'escape' => false),
	false
);
echo $this->Html->link(
	'',
	array('controller' => 'accounts', 'action' => 'activatem'),
	array('id' => 'linkActivateSelected_')
);
?>
</div>

<script type="text/javascript">
jQuery(":checkbox").attr({style: "border:0px;width:16px;vertical-align:middle;"}); 
</script>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<?php
echo $this->element('paginationblock');
?>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->