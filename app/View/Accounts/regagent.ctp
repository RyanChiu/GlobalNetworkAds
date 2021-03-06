<?php
//echo '<br/>';
//echo print_r($data, true);
$userinfo = $this->Session->read('Auth.User.Account');
$action = 'regagent';
$title = 'A New Seller';
if ($userinfo['role'] == 1) {
	$action = 'requestchg';
	$title = 'Request For New Seller';
}
?>
<?php
echo $this->Form->create(
	null, 
	array(
		'url' => array('controller' => 'accounts', 'action' => $action), 
		'id' => 'frmReg'
	)
);
if ($userinfo['role'] == 1) {
	echo $this->Form->input('Requestchg.role', array('type' => 'hidden', 'value' => '2'));
	echo $this->Form->input('Requestchg.type', array('type' => 'hidden', 'value' => 'reg'));
	echo $this->Form->input('Requestchg.from', array('type' => 'hidden', 'value' => $curcom['Company']['manemail']));
	echo $this->Form->input('Requestchg.offiname', array('type' => 'hidden', 'value' => $curcom['Company']['officename']));
}
?>

<div class="table-responsive">
<table class="w-100" style="border:0;">
	<tr><td style="text-decoration:underline;font-weight:bold;" colspan=2 >
	Fields marked with an asterisk (<font color="red">*</font>) are required.
	</td></tr>
	<tr>
		<td width="248" class="search-label">Team : <font color="red">*</font></td>
		<td>
		<div style="float:left">
		<?php
		if ($userinfo['role'] == 0) {// means an administrator
			echo $this->Form->input('Agent.companyid',
				array('type' => 'select', 'options' => $cps,
					'label' => '', 'style' => 'width:200px;'
				)
			);
		} else if ($userinfo['role'] == 1) {// means an office
			echo $this->Form->input('Agent.companyshadow',
				array(
					'label' => '',
					'style' => 'width:200px;border:0px;background:transparent;',
					'readonly' => 'readonly',
					'value' => $cps[$userinfo['id']]
				)
			);
			echo $this->Form->input('Agent.companyid', array('type' => 'hidden', 'value' => $userinfo['id']));
		}
		?>
		</div>
		
		</td>
		<!--  
		<td rowspan="16" align="center"><?php //echo $this->Html->image('iconDollarsKey.png', array('width' => '160')); ?></td>
		-->
	</tr>
	<tr>
		<td class="search-label">First Name : <font color="red">*</font></td>
		<td>
		<div style="float:left">
		<?php
		echo $this->Form->input('Agent.ag1stname', array('label' => '', 'style' => 'width:200px;'));
		?>
		</div>
		
		</td>
	</tr>
	<tr>
		<td class="search-label">Last Name : <font color="red">*</font></td>
		<td>
		<div style="float:left">
		<?php
		echo $this->Form->input('Agent.aglastname', array('label' => '', 'style' => 'width:200px;'));
		?>
		</div>
		
		</td>
	</tr>
	<tr>
		<td class="search-label">Email : <font color="red">*</font></td>
		<td>
		<div style="float:left">
		<?php
		echo $this->Form->input('Agent.email', array('label' => '', 'style' => 'width:200px;'));
		?>
		</div>
		
		</td>
	</tr>
	<tr>
		<td class="search-label">
		<div style="float:left">User : <font color="red">*</font></div>
		<div style="float:left; display: none;">
		<?php
		echo '('
			. $this->Form->checkbox(
				'Account.auto',
				array(
					//'checked' => 'checked',
					'style' => 'border:0px;width:16px;'
				)
			)
			. 'Auto-generated)';
		?>
		</div>
		</td>
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
	<tr style="display:none;">
		<td>Street Name &amp; Number : </td>
		<td>
		<div style="float:left">
		<?php
		echo $this->Form->input('Agent.street', array('label' => '', 'value' => 'N/A', 'style' => 'width:200px;'));
		?>
		</div>
		</td>
	</tr>
	<tr style="display:none;">
		<td>City : </td>
		<td>
		<div style="float:left">
		<?php
		echo $this->Form->input('Agent.city', array('label' => '', 'value' => 'N/A', 'style' => 'width:200px;'));
		?>
		</div>
		</td>
	</tr>
	<tr style="display:none;">
		<td>State &amp; Zip : </td>
		<td>
		<div style="float:left">
		<?php
		echo $this->Form->input('Agent.state', array('label' => '', 'value' => 'N/A', 'style' => 'width:200px;'));
		?>
		</div>
		</td>
	</tr>
	<tr style="display:none;">
		<td>Country : <font color="red">*</font></td>
		<td>
		<div style="float:left">
		<?php
		echo $this->Form->select('Agent.country', $cts, array('value' => 'PH', 'style' => 'width:200px;'));
		?>
		</div>
		
		</td>
	</tr>
	<tr style="display:none;">
		<td>Instant Messenger Contact : <font color="red">*</font><br/><small>(AIM, Yahoo, Skype, MSN, ICQ</small></td>
		<td>
		<div style="float:left">
		<?php
		echo $this->Form->input('Agent.im', array('label' => '', 'value' => 'N/A', 'style' => 'width:200px;'));
		?>
		</div>
		
		</td>
	</tr>
	<tr style="display:none;">
		<td>Cell NO. : <font color="red">*</font></td>
		<td>
		<div style="float:left">
		<?php
		echo $this->Form->input('Agent.cellphone', array('label' => '', 'value' => 'N/A', 'style' => 'width:200px;'));
		?>
		</div>
		
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
				'value' => $selsites
			)
		);
		?>
		</td>
	</tr>
	<tr>
		<td class="search-label">
		<?php
		echo $this->Form->input('Account.status', array('type' => 'hidden', 'value' => '-1'));//the default status if unapproved
		?>
		</td>
		<td>
		<?php
		if ($userinfo['role'] == 0 || $userinfo['role'] == 1) {//means an administrator or an office
			echo $this->Form->submit('Add & New',
				array(
					'default' => 'default',
					'div' => array('style' => 'float:left;margin-right:15px;'),
					'style' => 'width:112px;',
					'class' => 'btn btn-sm btn-secondary text-light',
					'onclick' => 'javascript:__changeAction(\'frmReg\', \''
						. $this->Html->url(array('controller' => 'accounts', 'action' => 'regagent', 'id' => -1))
						. '\');' 
				)
			);
			echo $this->Form->submit('Add',
				array(
					'div' => array('style' => 'float:left;margin-right:15px;'),
					'style' => 'width:112px;',
					'class' => 'btn btn-sm btn-secondary text-light',
					'onclick' => 'javascript:__changeAction(\'frmReg\', \''
						. $this->Html->url(array('controller' => 'accounts', 'action' => 'regagent'))
						. '\');'
				)
			);
		}
		/*
		if ($userinfo['role'] == 1) {
			echo $this->Form->submit('Send Request',
				array('div' => array('style' => 'float:left;margin-right:15px;'))
			);
		}
		*/
		?>
		</td>
	</tr>
</table>
</div>
<script type="text/javascript"> 
jQuery(":checkbox").attr({style: "border:0px;width:16px;vertical-align:middle;"});
jQuery("#AccountUsername").keyup(function(){
	//this.value = this.value.replace('/^[a-z]{1,3}\d{0,4}_{0,1}\d{0,2}$/i', '');
	this.value = this.value.toUpperCase();
});
function dimUsernameInput() {
	if (jQuery("#AccountAuto").attr("checked") == true) {
		jQuery("#AccountUsername").attr('disabled','disabled');
	} else {
		jQuery("#AccountUsername").removeAttr('disabled');
	}
}
dimUsernameInput();
jQuery("#AccountAuto").click(function(){
	dimUsernameInput();
});
</script>
<?php
echo $this->Form->input('Account.role', array('type' => 'hidden', 'value' => '2'));//the value 2 as being an agent
echo $this->Form->input('Account.regtime', array('type' => 'hidden', 'value' => ''));//should be set to current time when saving into the DB
echo $this->Form->input('Account.online', array('type' => 'hidden', 'value' => '0'));// the value 0 means "offline"
echo $this->Form->input('Agent.id', array('type' => 'hidden'));
echo $this->Form->end();
?>

<!-- fancybox popup tips -->
<div style="display:none">
	<a id="tips_link" href="#tips_for_creating">show tips</a>
</div>
<div style="display:none">
	<div id="tips_for_creating" 
		style="width:500px;background-color:#FFFFCC;padding:8px;">
		<font style="font-weight:bold;color:red;">MANAGER, AFTER SELLER IS CREATED,</font> <b>PLEASE GO TO:</b><br/>
		1. MAIN MENU: <br/>
		2. ALLOW NEW SELLER; <br/>
		3. CLICK <?php echo $this->Html->image('iconActivate.png', array('border' => 0, 'width' => 16, 'height' => 16)); ?> TO ALLOW <br/>
		4. SELLER RID TAKES 1 HOUR TO ACTIVATE AFTER CREATION, <br/>
		5. SELLER MUST BE APPOREVED TO LOG IN.
	</div>
</div>
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery("a#tips_link").fancybox({
		'type': 'inline',
		'margin': 0,
		'padding': 0,
		'overlayOpacity': 0.6,
		'overlayColor': '#0A0A0A',
		'showCloseButton': true,
		'modal': false
	});
	//jQuery("a#tips_link").click();
})
</script>