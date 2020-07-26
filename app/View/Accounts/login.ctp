<center>
	<b><font color="red"><?php echo $this->Session->flash('auth'); ?> </font> </b>
	<font color="red"><?php echo $this->Session->flash(); ?> </font>
</center>

<?php
echo $this->Form->create(null, array('url' => array('controller' => 'accounts', 'action' => 'login')));
?>
<div class="container">
	<div class="form-row w-100 mb-1">
		<label for="iptUsername" class="col-sm-4 text-right zLoginTitle">User Name:</label>
		<?php
		echo $this->Form->input(
			'Account.username', 
			array(
				'label' => false,
				'div' => array('class' => 'col-sm-5'),
				'id' => 'iptUsername',
				'class' => 'form-control', 
				//'placeholder' => 'USER NAME'
			)
		);
		?>
	</div>
	<div class="form-row w-100 mb-1">
		<label for="iptPassword" class="col-sm-4 text-right zLoginTitle">Password:</label>
		<?php
		echo $this->Form->input(
			'Account.password', 
			array(
				'label' => false,
				'div' => array('class' => 'col-sm-5'),
				'id' => 'iptPassword',
				'class' => 'form-control',
				//'placeholder' => 'Password',
				'type' => 'password'
			)
		);
		?>
		<script type="text/javascript">
		jQuery("#AccountUsername").focus();
		</script>
	</div>
	<div class="form-row w-100 mb-1">
		<label for="iptVcode" class="col-sm-4 text-right zLoginTitle">Captcha:</label>
		<?php
		echo $this->Form->input(
			'Account.vcode', 
			array(
				'label' => false,
				'div' => array('class' => 'col-sm-5'),
				'id' => 'iptVcode',
				'class' => 'form-control',
				//'placeholder' => 'Validation code'
			)
		);
		?>
	</div>
	<div class="form-row w-100">
		<div class="container-fluid text-center">
		<?php
		echo $this->Html->link(
			$this->Html->image(array('controller' => 'accounts', 'action' => 'phpcaptcha'),
				array(
					'class' => 'rounded-pill',
					'style' => 'width:125px;height:36px;margin:2px 0 3px 6px;',
					'id' => 'imgVcodes', 
					'onclick' => 'javascript:__chgVcodes();'
				)
			),
			'#',
			array(
				'escape' => false, 
				'title' => 'Click to try another one.(By entering this code you help yourself prevent spam and fake login.)'
			),
			false
		);
		?>
		</div>
		<script type="text/javascript">
		function __chgVcodes() {
			document.getElementById("imgVcodes").src =
				"<?php echo $this->Html->url(array('controller' => 'accounts', 'action' => 'phpcaptcha')); ?>"
				+ "?" + Math.random();
		}
		</script>
	</div>
	<center>
	<?php
	echo $this->Form->submit(
		'LET ME IN',
		//'ENTER.png',
		array(
			'class' => 'btn btn-md btn-secondary mt-1',
			'style' => 'min-width:210px;max-height:48px;'
		)
	);
	?>
	</center>
</div>

<?php
echo $this->Form->end();
?>

<div class="my-2">
	<?php
	echo $this->element('frauddefblock');
	?>
</div>

<script type="text/javascript">
for (var i = 0; i < 10; i++) {
	jQuery(".suspended-warning").animate({opacity: 'toggle'}, "slow");
}
</script>