<?php
$userinfo = $this->Session->read('Auth.User.Account');
//echo print_r($userinfo, true);
//echo '<br/>';
?>
<?php
//echo $this->element('timezoneblock');
?>

<?php
echo $this->Form->create(null, array('url' => array('controller' => 'accounts', 'action' => 'addchatlogs')));
?>
<div class="table-responsive">
<table style="width:100%;border:0;">
	<tr><td colspan="2">
	Fields marked with an asterisk (*) are required.<br/>
	<font color="red"><b>(Please  include  full chats only.)</b></font>
	</td></tr>
	<tr>
		<td width="232px">Client Name : <font color="red">*</font></td>
		<td align="left">
		<div style="float:left">
		<?php
		echo $this->Form->input('ChatLog.clientusername', array('label' => '', 'style' => 'width:200px;'));
		?>
		</div>
		
		</td>
	</tr>
	<tr>
		<td>Site : <font color="red">*</font></td>
		<td>
		<div style="float:left">
		<?php
		echo $this->Form->input('ChatLog.siteid', array('label' => '', 'style' => 'width:200px;', 'type' => 'select', 'options' => $sites));
		?>
		</div>
		
		</td>
	</tr>
	<tr>
		<td>Conversation : <font color="red">*</font></td>
		<td align="left">
		<div style="float:left">
		<?php
		echo $this->Form->input('ChatLog.conversation', array('label' => '', 'style' => 'width:200px;', 'rows' => 9));
		?>
		</div>
		
		</td>
	</tr>
	<tr>
		<td>
		<?php
		echo $this->Form->input('ChatLog.agentid', array('label' => '', 'type' => 'hidden', 'value' => $userinfo['id']));
		?>
		</td>
		<td><?php echo $this->Form->submit('Submit', array('style' => 'width:120px;', 'class' => 'btn btn-sm btn-secondary text-light'));?></td>
	</tr>
</table>
</div>
<?php
echo $this->Form->end();
?>