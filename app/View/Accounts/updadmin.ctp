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
		<td></td>
		<td><?php echo $this->Form->submit('Update', array('style' => 'width:112px;', 'class' => 'btn btn-secondary text-light')); ?></td>
	</tr>
</table>
<?php
echo $this->Form->input('Account.id', array('type' => 'hidden'));
echo $this->Form->input('Admin.id', array('type' => 'hidden'));
echo $this->Form->end();
?>
