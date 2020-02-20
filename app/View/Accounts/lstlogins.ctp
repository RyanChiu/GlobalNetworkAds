<?php 
$this->Js->JqueryEngine->jQueryObject = 'jQuery';
echo $this->Html->scriptBlock(
		array('inline' => false)
);
?>

<?php
//echo $this->element('timezoneblock');
?>

<?php
$userinfo = $this->Session->read('Auth.User.Account');
?>

<?php
echo $this->Form->create(null, array('url' => array('controller' => 'accounts', 'action' => 'lstlogins')));
?>
<table class="table-borderless w-100 my-2">
	<tr><td>
	<div class="form-row">
		<div class="form-inline">
			<div class="bg-transparent col" style="width:120px;">
				<b>Date Start:</b>
			</div>
			<div class="col">
			<?php
			echo $this->Form->input('ViewOnlineLog.startdate',
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
			echo $this->Form->input('ViewOnlineLog.enddate',
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
					'update' => '#ViewOnlineLogAgentid',
					'before' => 'Element.hide(\'divAgentid\');Element.show(\'divAgentidLoading\');',
					'complete' => 'Element.show(\'divAgentid\');Element.hide(\'divAgentidLoading\');',
					'async' => true,
					'dataExpression' => true,
					'method' => 'post',
					'data' => $this->Js->serializeForm(array('isForm' => false, 'inline' => true))
				)
			));
			?>
			</div>
		</div>
		<div class="form-inline">
			<div class="bg-transparent col" style="width:120px;">
				<b>Seller:</b>
			</div>
			<div class="col">
			<?php
			echo $this->Form->input('ViewOnlineLog.agentid',
				array('label' => '',
					'options' => $ags, 'type' => 'select',
					'value' => $selagent,
					'class' => 'form-contorl', 'style' => 'width:200px;',
					'div' => array('id' => 'divAgentid')
				)
			);
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
				<b>IP:</b>
			</div>
			<div class="col">
			<?php
			echo $this->Form->input('ViewOnlineLog.inip',
				array(
					'label' => '',
					'value' => $inip,
					'class' => 'form-contorl', 'style' => 'width:200px;',
					'div' => array('id' => 'divInip')
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

	</td></tr>
</table>
<?php
echo $this->Form->end();
?>

<div class="table-responsive">
<table class="table-sm w-100">
<thead class="bg-warning">
<tr class="text-black">
	<th class="text-center"><b><?php echo $this->ExPaginator->sort('ViewOnlineLog.username', 'Username', array('class' => 'text-reset')); ?></b></th>
	<th class="text-center"><b><?php echo $this->ExPaginator->sort('ViewOnlineLog.inip', 'IP', array('class' => 'text-reset')); ?></b></th>
	<th class="text-center"><b><?php echo $this->ExPaginator->sort('ViewOnlineLog.intime', 'Log in', array('class' => 'text-reset')); ?></b></th>
	<th class="text-center"><b><?php echo $this->ExPaginator->sort('ViewOnlineLog.outtime', 'Log out', array('class' => 'text-reset')); ?></b></th>
</tr>
</thead>
<?php
$i = 0;
foreach ($rs as $r) {
?>
<tr <?php echo $i % 2 == 0? '' : 'class="odd"'; ?>>
	<td align="center"><?php echo $r['ViewOnlineLog']['username']; ?></td>
	<td align="center">
		<a href="http://whatismyipaddress.com/ip/<?php echo $r['ViewOnlineLog']['inip']; ?>" target="findip_window">
			<?php echo $r['ViewOnlineLog']['inip']; ?>
		</a>
	</td>
	<td align="center"><?php echo $r['ViewOnlineLog']['intime']; ?></td>
	<td align="center"><?php echo $r['ViewOnlineLog']['outtime']; ?></td>
</tr>
<?php
$i++;
}
?>
</table>
</div>

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