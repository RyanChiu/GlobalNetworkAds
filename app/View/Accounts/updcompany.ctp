<?php
$userinfo = $this->Session->read('Auth.User.Account');
echo $this->Form->create(
	null, 
	array(
		'url' => array('controller' => 'accounts', 'action' => 'updcompany')
	)
);
?>
<div class="table-responsive">
<table style="width:100%;border:0;">
	<tr><td style="text-decoration:underline;font-weight:bold;" colspan=2 >
	Fields marked with an asterisk (<font color="red">*</font>) are required.
	</td></tr>
	<tr>
		<td width="232" class="search-label">Team Name : <font color="red">*</font></td>
		<td>
		<div style="float:left">
		<?php
		echo $this->Form->input('Company.officename', array('label' => '', 'style' => 'width:200px;'));
		?>
		</div>
		
		</td>
		<!--  
		<td rowspan="15" align="center"><?php //echo $this->Html->image('iconGiveDollars.png', array('width' => '160')); ?></td>
		-->
	</tr>
	<tr>
		<td class="search-label">Manager's First Name : <font color="red">*</font></td>
		<td>
		<div style="float:left">
		<?php
		echo $this->Form->input('Company.man1stname', array('label' => '', 'style' => 'width:200px;'));
		?>
		</div>
		
		</td>
	</tr>
	<tr>
		<td class="search-label">Manager's Last Name : <font color="red">*</font></td>
		<td>
		<div style="float:left">
		<?php
		echo $this->Form->input('Company.manlastname', array('label' => '', 'style' => 'width:200px;'));
		?>
		</div>
		
		</td>
	</tr>
	<tr>
		<td class="search-label">Manager's Email : <font color="red">*</font></td>
		<td>
		<div style="float:left">
		<?php
		echo $this->Form->input('Company.manemail', array('label' => '', 'style' => 'width:200px;'));
		?>
		</div>
		
		</td>
	</tr>
	<tr>
		<td class="search-label">Skype / Telegram : <font color="red">*</font></td>
		<td>
		<div style="float:left">
		<?php
		echo $this->Form->input('Company.skypetelegram', array('label' => '', 'style' => 'width:200px;'));
		?>
		</div>
		
		</td>
	</tr>
	<tr>
		<td class="search-label">User : <font color="red">*</font></td>
		<td>
		<div style="float:left">
		<?php
		echo $this->Form->input('Account.username', array('label' => '', 'style' => 'width:200px;'));
		?>
		</div>
		
		</td>
	</tr>
	<tr>
		<td class="search-label">Pass : <font color="red">*</font></td>
		<td>
		<div style="float:left">
		<?php
		echo $this->Form->input('Account.password', array('label' => '', 'style' => 'width:200px;', 'type' => 'password'));
		?>
		</div>
		
		</td>
	</tr>
	<tr>
		<td class="search-label">Confirm Pass : <font color="red">*</font></td>
		<td>
		<div style="float:left">
		<?php
		echo $this->Form->input('Account.originalpwd', array('label' => '', 'style' => 'width:200px;', 'type' => 'password'));
		?>
		</div>
		
		</td>
	</tr>
	<tr>
		<td class="search-label">Bank Name BDO : </td>
		<td>
		<div style="float:left">
		<?php
		echo $this->Form->input('Company.banknamebdo', array('label' => '', 'style' => 'width:200px;'));
		?>
		</div>
		</td>
	</tr>
	<tr>
		<td class="search-label">Account Name : </td>
		<td>
		<div style="float:left">
		<?php
		echo $this->Form->input('Company.bankaccount', array('label' => '', 'style' => 'width:200px;'));
		?>
		</div>
		</td>
	</tr>
	<tr>
		<td class="search-label">Account # : </td>
		<td>
		<div style="float:left">
		<?php
		echo $this->Form->input('Company.banknum', array('label' => '', 'style' => 'width:200px;'));
		?>
		</div>
		</td>
	</tr>
	<tr>
		<td class="search-label">SWIFT Code : <font color="red">*</font></td>
		<td>
		<div style="float:left">
		<?php
		echo $this->Form->input('Company.swiftcode', array('label' => '', 'style' => 'width:200px;'));
		?>
		</div>
		
		</td>
	</tr>
	<tr>
		<td class="search-label">Routing # : </td>
		<td>
		<?php
		echo $this->Form->input('Company.routingnum', array('label' => '', 'style' => 'width:200px;'));
		?>
		</td>
	</tr>
	<tr>
		<td class="search-label">Associated Sites: </td>
		<td>
		<?php
		$selsites = array_diff($sites, $exsites);
		$selsites = array_keys($selsites);
		echo $this->Form->select('SiteExcluding.siteid',
			$sites,
			array(
				'multiple' => 'checkbox',
				'disabled' => 'false',
				'value' => $selsites
			)
		);
		if ($userinfo['role'] != 0) {//means not an administrator
		?>
			<div id="msgbox_nochange" style="display:none;float:left;background-color:#ffffcc;">
			<font color="red">
			Sorry, you can't do this.If you want to, please contact your administrator.
			</font>
			</div>
			<script type="text/javascript">
			jQuery(":checkbox").click(
					function () {
						jQuery("#msgbox_nochange").show("normal");
						return false;
					}
			);
			jQuery("#msgbox_nochange").click(
					function () {
						jQuery(this).toggle("normal");
					}
			);
			</script>
		<?php	
		}
		?>
		</td>
	</tr>
	<tr>
		<td class="search-label">
		<label id="labelUAS">Activated</label>
		<?php
		echo $this->Form->checkbox(
			'Account.status'
		);
		?>
		</td>
		<td>
		<?php
		echo $this->Form->submit('Update', array('style' => 'width:112px;', 'class' => 'btn btn-sm btn-secondary text-light'));
		?>
		</td>
	</tr>
</table>
</div>
<script type="text/javascript">
jQuery(":checkbox").attr({
	style: "border: 0px; width: 16px; margin-left: 2px; vertical-align: middle;"
});

jQuery("#AccountStatus").click(function() {
	if (jQuery("#AccountStatus").attr("checked")) {
		jQuery("#AccountStatus").val(1);
	} else {
		jQuery("#AccountStatus").val(0);
	}
});

if (jQuery("#AccountStatus").val() == "-1") {
	jQuery("#labelUAS").text("Approved");
	jQuery("#AccountStatus").attr("checked", false);
	jQuery("#AccountStatus").val(-1);
	jQuery("#AccountStatus_").val(-1);
} else {
	jQuery("#labelUAS").text("Activated");
}
</script>
<?php
echo $this->Form->input('Account.id', array('type' => 'hidden'));
echo $this->Form->input('Account.role', array('type' => 'hidden', 'value' => '1'));//the value 1 as being an office
echo $this->Form->input('Company.id', array('type' => 'hidden'));
echo $this->Form->end();
?>
