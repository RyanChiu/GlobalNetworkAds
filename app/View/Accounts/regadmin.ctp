<?php
$userinfo = $this->Session->read('Auth.User.Account');
echo $this->Form->create(
	null, 
	array(
		'url' => array('controller' => 'accounts', 'action' => 'regadmin'),
		'id' => 'frmReg'
	)
);
?>
<div class="table-responsive">
<table style="width:100%;border:0;">
	<tr><td style="text-decoration:underline;font-weight:bold;" colspan=2 >
	Fields marked with an asterisk (<font color="red">*</font>) are required.
	</td></tr>
	<tr>
		<td class="search-label">User : <font color="red">*</font></td>
		<td>
		<div style="float:left">
		<?php
		echo $this->Form->input('Account.username', array('label' => '', 'style' => 'width:390px;'));
		?>
		</div>
		
		</td>
	</tr>
	<tr>
		<td class="search-label">Pass : <font color="red">*</font></td>
		<td>
		<div style="float:left">
		<?php
		echo $this->Form->input('Account.password', array('label' => '', 'style' => 'width:390px;', 'type' => 'password'));
		?>
		</div>
		
		</td>
	</tr>
	<tr>
		<td class="search-label">Confirm Pass : <font color="red">*</font></td>
		<td>
		<div style="float:left">
		<?php
		echo $this->Form->input('Account.originalpwd', array('label' => '', 'style' => 'width:390px;', 'type' => 'password'));
		?>
		</div>
		
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
		if (in_array($userinfo['id'], array(1, 2))) {
		?>
		<label id="labelUAS">Earning visible :</label>
		<?php echo $this->Form->checkbox('Account.level'); ?>
		</td>
		<?php 
		}
		?>
		<td><?php echo $this->Form->submit('Add', array('style' => 'width:112px;', 'class' => 'btn btn-secondary text-light')); ?></td>
	</tr>
</table>
</div>

<?php 
echo $this->Form->input('Account.id', array('type' => 'hidden'));
echo $this->Form->input('Account.role', array('type' => 'hidden', 'value' => 0));
echo $this->Form->input('Account.status', array('type' => 'hidden', 'value' => 1));
echo $this->Form->input('Admin.id', array('type' => 'hidden'));
echo $this->Form->input('Admin.notes', array('type' => 'hidden', 'value' => ''));
echo $this->Form->end();
?>

<script type="text/javascript">
jQuery(":checkbox").attr({style: "border:0px;width:16px;vertical-align:middle;"});
</script>