<br/>
<?php
//echo print_r($rs, true);
$userinfo = $this->Session->read('Auth.User.Account');
echo $this->Form->create(
	null, 
	array(
		'url' => array('controller' => 'accounts', 'action' => 'updadmin')
	)
);
?>
<table style="width:100%">
	<caption>Fields marked with an asterisk (*) are required.</caption>
	<tr>
		<td class="search-label">User : </td>
		<td>
		<div style="float:left">
		<?php
		echo $this->Form->input('Account.username', 
			array('label' => '', 
				'style' => 'width:390px;color:black;background:transparent;border:0;', 
				'readonly' => 'readonly'
			)
		);
		?>
		</div>
		<div style="float:left"><font color="red">*</font></div>
		</td>
	</tr>
	<tr>
		<td class="search-label">Pass : </td>
		<td>
		<div style="float:left">
		<?php
		echo $this->Form->input('Account.password', array('label' => '', 'type' => 'password', 'style' => 'width:390px;'));
		?>
		</div>
		<div style="float:left"><font color="red">*</font></div>
		</td>
	</tr>
	<tr>
		<td class="search-label">Confirm pass :</td>
		<td>
		<div style="float:left">
		<?php
		echo $this->Form->input('Account.originalpwd', array('label' => '', 'type' => 'password', 'style' => 'width:390px;'));
		?>
		</div>
		<div style="float:left"><font color="red">*</font></div>
		</td>
	</tr>
	<tr>
		<td class="search-label">Email Address :</td>
		<td>
		<div style="float:left">
		<?php
		echo $this->Form->input('Admin.email', array('label' => '', 'style' => 'width:390px;'));
		?>
		</div>
		<div style="float:left"><font color="red">*</font></div>
		</td>
	</tr>
	<tr>
		<td class="search-label">
		<?php 
		if (in_array($userinfo['id'], array(1, 2))
			&& !in_array($rs['Account']['id'], array(1, 2))) {
		?>
		<label id="labelUAS">Earning visible :</label>
		<?php echo $this->Form->checkbox('Account.level') . ", "; ?>
		<label>Activated :</label>
		<?php echo $this->Form->checkbox('Account.status'); ?>
		<?php 
		}
		?>
		</td>
		<td><?php echo $this->Form->submit('Update', array('style' => 'width:112px;', 'class' => 'btn btn-secondary text-light')); ?></td>
	</tr>
</table>
<?php
echo $this->Form->input('Account.id', array('type' => 'hidden'));
echo $this->Form->input('Account.role', array('type' => 'hidden'));
echo $this->Form->input('Admin.id', array('type' => 'hidden'));
echo $this->Form->end();
?>

<script type="text/javascript">
jQuery(":checkbox").attr({
	style: "border: 0px; width: 16px; margin-left: 2px; vertical-align: middle;"
});
</script>
