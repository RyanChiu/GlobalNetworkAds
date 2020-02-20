<?php 
$this->Js->JqueryEngine->jQueryObject = 'jQuery';
echo $this->Html->scriptBlock(
		array('inline' => false)
);
?>

<?php
$userinfo = $this->Session->read('Auth.User.Account');
//echo print_r($userinfo, true);
//echo '<br/>';
?>

<?php
//echo $this->element('timezoneblock');
?>

<?php
echo $this->Form->create(null, array('url' =>  array('controller' => 'accounts', 'action' => 'lstchatlogs')));
?>
<table class="table-borderless w-100">
	<tr><td>
	<div class="form-row">
		<div class="form-inline">
			<div class="bg-transparent col" style="width:120px;">
				<b>Date Start:</b>
			</div>
			<div class="col">
			<?php
			echo $this->Form->input('ViewChatLog.startdate',
				array(
					'label' => '', 
					'id' => 'datepicker_start', 
					'class' => 'form-contorl', 'style' => 'width:200px;', 
					'value' => $startdate
				)
			);
			?>
			</div>
		</div>
		<div class="form-inline">
			<div class="bg-transparent col" style="width:120px;">
				<b>Date End:</b>
			</div>
			<div class="col">
			<?php
			echo $this->Form->input('ViewChatLog.enddate',
				array(
					'label' => '', 
					'id' => 'datepicker_end', 
					'class' => 'form-contorl', 'style' => 'width:200px;', 
					'value' => $enddate
				)
			);
			?>
			</div>
		</div>
	</div>

	<div class="form-row">
		<div class="form-inline">
			<div class="bg-transparent col" style="width:120px;">
				<b>Team:</b>
			</div>
			<div class="col">
			<?php
			if ($userinfo['role'] != 2) {
				echo $this->Form->input('Stats.companyid',
					array('label' => '',
						'options' => $coms, 'type' => 'select',
						'value' => $selcom,
						'class' => 'form-contorl', 'style' => 'width:200px;'
					)
				);
				$this->Js->get("#StatsCompanyid")->event("change", $this->Js->request(
					array(
						'controller' => 'stats', 'action' => 'switchagent'
					),
					array(
						'update' => '#ViewChatLogAgentid',
						'before' => 'Element.hide(\'divAgentid\');Element.show(\'divAgentidLoading\');',
						'complete' => 'Element.show(\'divAgentid\');Element.hide(\'divAgentidLoading\');',
						'async' => true,
						'dataExpression' => true,
						'method' => 'post',
						'data' => $this->Js->serializeForm(array('isForm' => false, 'inline' => true))
					)
				));
			} else {
				echo $this->Form->input('Stats.companyid',
					array('label' => '',
						'type' => 'hidden',
						'value' => $selcom
					)
				);
				echo $coms[$selcom];
			}
			?>
			</div>
		</div>
		<div class="form-inline">
			<div class="bg-transparent col" style="width:120px;">
				<b>Seller:</b>
			</div>
			<div class="col">
			<?php
			if ($userinfo['role'] != 2) {
				echo $this->Form->input('ViewChatLog.agentid',
					array('label' => '',
						'options' => $ags, 'type' => 'select',
						'value' => $selagent,
						'class' => 'form-contorl', 'style' => 'width:200px;',
						'div' => array('id' => 'divAgentid')
					)
				);
			} else {
				echo $this->Form->input('ViewChatLog.agentid',
					array('label' => '',
						'type' => 'hidden',
						'value' => $selagent
					)
				);
				echo $ags[$selagent];
			}
			?>
			</div>
			<div id="divAgentidLoading" style="float:left;width:100px;margin-right:20px;display:none;">
			<?php echo $this->Html->image('iconAttention.gif') . '&nbsp;Loading...'; ?>
			</div>
		</div>
	</div>

	<div class="form-row">
		<div class="form-inline">
			<div class="bg-transparent col" style="width:120px;">
				<b>Site:</b>
			</div>
			<div class="col">
			<?php
			echo $this->Form->input('ViewChatLog.siteid',
				array('label' => '',
					'options' => $sites, 'type' => 'select',
					'value' => $selsite,
					'class' => 'form-contorl', 'style' => 'width:200px;'
				)
			);
			?>
			</div>
		</div>
		<div class="form-inline">
			<div class="bg-transparent col" style="width:120px;">
			<?php
			echo $this->Form->submit('Search', array('style' => 'width:110px;', 'class' => 'btn btn-sm btn-secondary text-light'));
			?>
			</div>
			<div class="col">
			<?php
			echo '';
			?>
			</div>
		</div>
	</div>

	</td></td>
</table>
<?php
echo $this->Form->end();
?>

<br/>
<div style="margin-bottom:3px">
<?php
if (in_array($userinfo['role'], array(2))) {//means an agent
	echo $this->Form->button('Submit Chat Log...',
		array(
			'onclick' => 'javascript:location.href="' .
				$this->Html->url(array('controller' => 'accounts', 'action' => 'addchatlogs')) . '"',
			'style' => 'width:160px;',
			'class' => 'btn btn-link'
		)
	);
}
?>
</div>
<?php
if (!empty($rs)) {
?>
	<div class="table-responsive">
	<table class="table-sm w-100">
	<thead class="bg-warning">
	<tr class="text-black">
		<th><b><?php echo $this->ExPaginator->sort('ViewChatLog.officename', 'Team', array('class' => 'text-reset')); ?></b></th>
		<th><b><?php echo $this->ExPaginator->sort('ViewChatLog.username4m', 'Seller', array('class' => 'text-reset')); ?></b></th>
		<th><b><?php echo $this->ExPaginator->sort('ViewChatLog.sitename', 'Site', array('class' => 'text-reset')); ?></b></th>
		<th><b><?php echo $this->ExPaginator->sort('ViewChatLog.clientusername', 'Client Name', array('class' => 'text-reset')); ?></b></th>
		<th><b><?php echo 'Conversation'; ?></b></th>
		<th><b><?php echo $this->ExPaginator->sort('ViewChatLog.submittime', 'Submit Time', array('class' => 'text-reset')); ?></b></th>
	</tr>
	</thead>
	<?php
	$i = 0;
	foreach ($rs as $r) {
	?>
	<tr <?php echo $i % 2 == 0? '' : 'class="odd"'; ?>>
		<td align="center"><?php echo $r['ViewChatLog']['officename']; ?></td>
		<td align="center"><?php echo $r['ViewChatLog']['username']; ?></td>
		<td align="center"><?php echo $r['ViewChatLog']['sitename']; ?></td>
		<td align="center"><?php echo $r['ViewChatLog']['clientusername']; ?></td>
		<td><?php echo str_replace("\n", "<br/>", $r['ViewChatLog']['conversation']); ?></td>
		<td align="center"><?php echo $r['ViewChatLog']['submittime']; ?></td>
	</tr>
	<?php
	$i++;
	}
	?>
	</table>
	</div>
<?php
}
?>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<?php
echo $this->element('paginationblock');
?>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery(function() {
		jQuery('#datepicker_start').datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'
		});
	});
});
</script>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery(function() {
		jQuery('#datepicker_end').datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'
		});
	});
});
</script>