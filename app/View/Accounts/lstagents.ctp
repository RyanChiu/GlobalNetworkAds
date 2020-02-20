<?php
/*
echo '<br/>';
echo print_r($url, true);
echo print_r($pass, true);
echo print_r($passedArgs, true);
*/
$userinfo = $this->Session->read('Auth.User.Account');
?>
<?php
/*searching part*/
?>

<div class="w-100 mt-1">
<?php
echo $this->Form->create(
	null, 
	array(
		"url" => array('controller' => 'accounts', 'action' => 'lstagents'), 
		'id' => 'frmSearch'
	)
);
?>

<table class="w-100" style="border:0;">
	<tr><td>
	<div class="form-row">
		<div class="form-inline">
			<div class="bg-transparent col" style="width:120px;">
				<b>User:</b>
			</div>
			<div class="col">
			<?php
			echo $this->Form->input('ViewAgent.username', array('label' => '', 'class' => 'form-contorl', 'style' => 'width:200px;'));
			?>
			</div>
		</div>
		<?php
		if ($userinfo['role'] == 0) {
		?>
		<div class="form-inline">
			<div class="bg-transparent col" style="width:120px;">
				<b>Team:</b>
			</div>
			<div class="col">
			<?php
			echo $this->Form->input('Company.id',
				array('label' => '', 'type' => 'select',
					'options' => $coms,	'class' => 'form-contorl', 'style' => 'width:200px;'
				)
			);
			?>
			</div>
		</div>
		<?php
		}
		?>
	</div>

	<div class="form-row">
		<div class="form-inline">
			<div class="bg-transparent col" style="width:120px;">
				<b>Last Name:</b>
			</div>
			<div class="col">
			<?php
			echo $this->Form->input('ViewAgent.aglastname', array('label' => '', 'class' => 'form-contorl', 'style' => 'width:200px;'));
			?>
			</div>
		</div>
		<div class="form-inline">
			<div class="bg-transparent col" style="width:120px;">
				<b>First Name:</b>
			</div>
			<div class="col">
			<?php
			echo $this->Form->input('ViewAgent.ag1stname', array('label' => '', 'class' => 'form-contorl', 'style' => 'width:200px;'));
			?>
			</div>
		</div>
	</div>

	<div class="form-row">
		<div class="form-inline">
			<div class="bg-transparent col" style="width:120px;">
				<b>Offer ID:</b>
			</div>
			<div class="col">
			<?php
			echo $this->Form->input('AgentSiteMapping.campaignid', array('label' => '', 'class' => 'form-contorl', 'style' => 'width:200px;'));
			?>
			</div>
		</div>
		<div class="form-inline">
			<div class="bg-transparent col" style="width:120px;">
				<b>Email:</b>
			</div>
			<div class="col">
			<?php
			echo $this->Form->input('ViewAgent.email', array('label' => '', 'class' => 'form-contorl', 'style' => 'width:200px;'));
			?>
			</div>
		</div>
	</div>

	<div class="form-row">
		<div class="form-inline">
			<div class="bg-transparent col" style="width:120px;">
				<b>Suspended:</b>
			</div>
			<div class="col">
			<?php
			echo $this->Form->input('SiteExcluding.siteid',
				array('label' => '', 'type' => 'select',
					'options' => $sites, 'class' => 'form-contorl', 'style' => 'width:200px;'
				)
			);
			?>
			</div>
		</div>
		<div class="form-inline">
			<div class="bg-transparent col" style="width:120px;">
				<b>Status:</b>
			</div>
			<div class="col">
			<?php
			echo $this->Form->input('ViewAgent.status',
				array(
					'label' => '', 'class' => 'form-contorl', 'style' => 'width:200px;',
					'type' => 'select', 'options' => (array('-1' => 'All') + $status)
				)
			);
			?>
			</div>
		</div>
	</div>
	</td></td>
</table>

<table class="w-100" style="border:0;">
	
	<tr>
		<td colspan="2"></td>
		<td colspan="2">
		<div style="float:left;width:112px;">
		<?php echo $this->Form->submit('Search', array('style' => 'float:left;width:96px;', 'class' => 'btn btn-sm btn-secondary text-light')) ?>
		</div>
		<div style="float:left;">
		<?php echo $this->Form->submit('Clear', array('style' => 'float:left;width:96px;', 'class' => 'btn btn-sm btn-secondary text-light', 'onclick' => 'javascript:__zClearForm("frmSearch");')); ?>
		</div>
		</td>
	</tr>
</table>
<?php
$companyid = 0;
if ($userinfo['role'] == 1) {//means an office
	$companyid = $userinfo['id'];
}
echo $this->Form->input('ViewAgent.companyid', array('type' => 'hidden', 'value' => $companyid));
echo $this->Form->end();
?>
</div>

<?php
/*showing the results*/
?>
<script type="text/javascript">
function __setActSusLink() {
	var checkboxes;
	checkboxes = document.getElementsByName("data[ViewAgent][selected]");
	var ids = "";
	for (var i = 0; i < checkboxes.length; i++) {
		if (checkboxes[i].checked && checkboxes[i].value != 0) {
			ids += checkboxes[i].value + ",";
		}
	}
	document.getElementById("linkActivateSelected").href =
		document.getElementById("linkActivateSelected_").href + "/ids:" + ids + "/status:1/from:1";
	document.getElementById("linkSuspendSelected").href =
		document.getElementById("linkSuspendSelected_").href + "/ids:" + ids + "/status:0/from:1";
}
function __setCurSelectedToBeInformed() {
	var checkboxes;
	checkboxes = document.getElementsByName("data[ViewAgent][selected]");
	var ids = "";
	for (var i = 0; i < checkboxes.length; i++) {
		if (checkboxes[i].checked && checkboxes[i].value != 0) {
			ids += checkboxes[i].value + ",";
		}
	}
	document.getElementById("hidCurSelectedToBeInformed").value = ids;
}
function __setInfLink() {
	document.getElementById("linkInform").href =
		document.getElementById("linkInform_").href + "/from:1"
			+ "/ids:" + document.getElementById("hidCurSelectedToBeInformed").value
			+ "/notes:" + document.getElementById("txtNotes").value;
}
function __checkAll() {
	var checkboxes;
	checkboxes = document.getElementsByName("data[ViewAgent][selected]");
	for (var i = 0; i < checkboxes.length; i++) {
		checkboxes[i].checked = document.getElementById("checkboxAll").checked;
	}
}
</script>

<div style="margin-bottom:3px">
<?php
if (in_array($userinfo['role'], array(0, 1))) {//means an administrator or an office
	//echo $this->Form->button($userinfo['role'] == 0 ? 'Add Agent' : 'Request New Agent',
	echo $this->Form->button('Add Seller...',
		array(
			'onclick' => 'javascript:location.href=\'' .
				$this->Html->url(array('controller' => 'accounts', 'action' => 'regagent')) . '\'',
			'class' => 'btn btn-link'
		)
	);
}
?>
</div>

<div class="table-responsive">
<table class="table-sm w-100">
<thead class="bg-warning">
<tr class="text-black">
	<th class="text-black"><b>
	<?php
	echo $this->Form->checkbox('',
		array('id' => 'checkboxAll', 'value' => -1,
			'style' => 'border:0px;width:16px;',
			'onclick' => 'javascript:__checkAll();__setActSusLink();'
		)
	);
	?>
	#</b></th>
	<th><b><?php echo $this->ExPaginator->sort('ViewAgent.username4m', 'User', array('class' => 'text-reset')); ?></b></th>
	<th><b><?php echo $this->ExPaginator->sort('ViewAgent.originalpwd', 'Pass', array('class' => 'text-reset')); ?></b></th>
	<th><b><?php echo $this->ExPaginator->sort('ViewAgent.officename', 'Team', array('class' => 'text-reset')); ?></b></th>
	<th><b><?php echo $this->ExPaginator->sort('ViewAgent.regtime', 'Created', array('class' => 'text-reset')); ?></b></th>
	<th><b><?php echo $this->ExPaginator->sort('ViewAgent.lastlogintime', 'Last Login', array('class' => 'text-reset')); ?></b></th>
	<th><b><?php echo $this->ExPaginator->sort('ViewAgent.logintimes', 'Times', array('class' => 'text-reset')); ?></b></th>
	<th><b><?php echo $this->ExPaginator->sort('ViewAgent.status', 'Status', array('class' => 'text-reset')); ?></b></th>
	<th><b><?php echo $this->ExPaginator->sort('ViewAgent.campaigns', 'Offers', array('class' => 'text-reset')); ?></b></th>
	<th class="text-black"><b>Action</b></th>
	<th>
	<?php
	echo $this->Html->link(
		$this->Html->image('viewit.png', array('border' => 0)),
		array('controller' => 'accounts', 'action' => 'lstchatlogs'),
		array('title' => 'Click to all the chat logs.', 'escape' => false),
		false
	);
	?>
	</th>
</tr>
</thead>
<?php
$i = 0;
foreach ($rs as $r):
?>
<tr <?php echo $i % 2 == 0? '' : 'class="odd"'; ?>>
	<td>
	<?php
	echo $this->Form->checkbox('ViewAgent.selected',
		array('value' => $r['ViewAgent']['id'],
			'style' => 'border:0px;width:16px;',
			'onclick' => 'javascript:__setActSusLink();'
		)
	);
	echo '<font size="1">' . ($i + 1 + $limit * ($this->Paginator->current() - 1)) . '</font>';
	?>
	</td>
	<td><?php echo $r['ViewAgent']['username']; ?></td>
	<td><?php echo $r['ViewAgent']['originalpwd']; ?></td>
	<td><?php echo $r['ViewAgent']['officename']; ?></td>
	<td><?php echo $r['ViewAgent']['regtime']; ?></td>
	<td>
	<?php
	$lastintm = $r['ViewAgent']['lastlogintime'];
	echo empty($lastintm) ? '-' : $lastintm;
	?>
	</td>
	<td align="center">
	<?php
	if ($r['ViewAgent']['logintimes'] == 0) {
		echo $r['ViewAgent']['logintimes'];
	} else {
		echo $this->Html->link(
			$r['ViewAgent']['logintimes'] . '&nbsp;' . $this->Html->image('iconList.gif', array('border' => 0)),
			array('controller' => 'accounts', 'action' => 'lstlogins', 'id' => $r['ViewAgent']['id']),
			array('title' => 'Click to the login logs', 'escape' => false), 
			false
		);
	}
	?>
	</td>
	<td><?php echo $status[$r['ViewAgent']['status']]; ?></td>
	<td align="center">
	<?php
	echo $this->Html->link(
		$r['ViewAgent']['campaigns'] . '&nbsp;' . $this->Html->image('iconList.gif', array('border' => 0)),
		array('controller' => 'links', 'action' => 'lstcampaigns', 'id' => $r['ViewAgent']['id']),
		array('title' => 'Click to the campaigns.', 'escape' => false), 
		false
	);
	?>
	</td>
	<td align="center">
	<?php
	echo $this->Html->link(
		$this->Html->image('iconEdit.png', array('border' => 0, 'width' => 16, 'height' => 16)) . '&nbsp;',
		array('controller' => 'accounts', 'action' => 'updagent', 'id' => $r['ViewAgent']['id']),
		array('title' => 'Click to edit this record.', 'escape' => false),
		false
	);
	echo $this->Html->link(
		$this->Html->image('iconActivate.png', array('border' => 0, 'width' => 16, 'height' => 16)) . '&nbsp;',
		array('controller' => 'accounts', 'action' => 'activatem', 'ids' => $r['ViewAgent']['id'], 'status' => 1, 'from' => 1),
		array('title' => 'Click to activate the user.', 'escape' => false),
		false
	);
	echo $this->Html->link( 
		$this->Html->image('iconSuspend.png', array('border' => 0, 'width' => 16, 'height' => 16)) . '&nbsp;',
		array('controller' => 'accounts', 'action' => 'activatem', 'ids' => $r['ViewAgent']['id'], 'status' => 0, 'from' => 1),
		array('title' => 'Click to suspend the user.', 'escape' => false),
		"Are you sure?"
	);
	?>
	</td>
	<td align="center">
	<?php
	echo $this->Html->link(
		$this->Html->image('chatlogs.png', array('border' => 0)),
		array('controller' => 'accounts', 'action' => 'lstchatlogs', 'id' => $r['ViewAgent']['id']),
		array('title' => 'Click to the chat logs.', 'escape' => false),
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
	array('id' => 'linkActivateSelected', 'title' => 'Click to activate the selected users.', 'escape' => false),
	false
);
echo $this->Html->link(
	'',
	array('controller' => 'accounts', 'action' => 'activatem'),
	array('id' => 'linkActivateSelected_')
);
/*suspend selected*/
echo $this->Html->link(
	$this->Html->image('iconSuspend.png', array('border' => 0, 'width' => 16, 'height' => 16)) . '&nbsp;&nbsp;',
	array('controller' => 'accounts', 'action' => 'activatem'),
	array('id' => 'linkSuspendSelected', 'title' => 'Click to suspend the selected users.', 'escape' => false),
	"Are you sure?"
);
echo $this->Html->link(
	'',
	array('controller' => 'accounts', 'action' => 'activatem'),
	array('id' => 'linkSuspendSelected_')
);
/*inform selected --*/
/*undim this block to function it
echo $this->Html->link(
	$this->Html->image('iconInform.png',
		array('id' => 'open_message',
			'border' => 0, 'width' => 16, 'height' => 16,
			'onclick' => 'javascript:__setCurSelectedToBeInformed();__setInfLink();'
		)
	),
	'#',
	array('title' => 'Click to inform the selected users.', 'escape' => false),
	false
);
*/
?>
</div>

<!-- ~~~~~~~~~~~~~~~~~~~the floating message box for "inform selected"~~~~~~~~~~~~~~~~~~~ -->
<div id="message_box" style="display:none;">
	<table style="width:100%">
	<thead><tr><th>
		<div style="float:left">Please enter your notes below.</div>
		<?php echo $this->Html->image('iconClose.png', array('id' => 'close_message', 'style' => 'float:right;cursor:pointer')); ?>
	</th></tr></thead>
	<tr><td><textarea id="txtNotes" style="width:99%" rows="6" onchange="javascript:__setInfLink();"></textarea></td></tr>
	<tr><td>
		<?php
		echo $this->Form->input('', array('type' => 'hidden', 'id' => 'hidCurSelectedToBeInformed'));
		echo $this->Html->link(
			'',
			array('controller' => 'accounts', 'action' => 'informem'),
			array('id' => 'linkInform_')
		);
		echo $this->Html->link(
			'Inform',
			array('controller' => 'accounts', 'action' => 'informem'),
			array('id' => 'linkInform'),
			false
		);
		?>
	</td></tr>
	</table>
</div>
<script type="text/javascript">
jQuery(":checkbox").attr({style: "border:0px;width:16px;vertical-align:middle;"}); 
</script>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<?php
echo $this->element('paginationblock');
?>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->