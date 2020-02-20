<?php 
$this->Js->JqueryEngine->jQueryObject = 'jQuery';
echo $this->Html->scriptBlock(
		array('inline' => false)
);
?>

<?php
$userinfo = $this->Session->read('Auth.User.Account');
//echo str_replace("\n", "<br>", print_r($rs[0], true));
?>
<?php
//echo $this->element('timezoneblock');
?>

<?php
echo $this->Form->create(null, array('url' => array('controller' => 'links', 'action' => 'lstclickouts')));
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
			echo $this->Form->input('ViewClickout.startdate',
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
			echo $this->Form->input('ViewClickout.enddate',
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
						'update' => '#StatsAgentid',
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
				echo $this->Form->input('Stats.agentid',
					array('label' => '',
						'options' => $ags, 'type' => 'select',
						'value' => $selagent,
						'class' => 'form-contorl', 'style' => 'width:200px;',
						'div' => array('id' => 'divAgentid')
					)
				);
			} else {
				echo $this->Form->input('Stats.agentid',
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
			echo $this->Form->input('Stats.siteid',
				array('label' => '',
					'options' => $sites, 'type' => 'select',
					'value' => $selsite,
					'class' => 'form-contorl', 'style' => 'width:200px;',
					'div' => array('id' => 'divSiteid')
				)
			);
			?>
			</div>
		</div>
		<div class="form-inline">
			<div class="bg-transparent col" style="width:120px;">
				<b>IP From:</b>
			</div>
			<div class="col">
			<?php
			echo $this->Form->input('ViewClickout.fromip',
				array(
					'label' => '',
					'value' => $fromip,
					'class' => 'form-contorl', 'style' => 'width:200px;',
					'div' => array('id' => 'divIpfrom')
				)
			);
			?>
			</div>
		</div>
	</div>

	<div class="form-row">
		<div class="form-inline">
			<div class="bg-transparent col" style="width:120px;">
			<?php
			echo $this->Form->submit('Search', array('style' => 'width:110px;', 'class' => 'btn btn-sm btn-secondary text-light'));
			?>
			</div>
			<div class="col">
			<?php
			echo '&nbsp;';
			?>
			</div>
		</div>
		<div class="form-inline">
			<div class="bg-transparent col" style="width:120px;">
				<b>&nbsp;</b>
			</div>
			<div class="col">
			<?php
			echo '&nbsp;';
			?>
			</div>
		</div>
	</div>

	</td></tr>
</table>
<?php
echo $this->Form->end();
?>

<div class="container-fluid p-0">
	Start Date:<?php echo $startdate; ?>&nbsp;&nbsp;End Date:<?php echo $enddate; ?>&nbsp;&nbsp;|&nbsp;&nbsp;
	Team:<?php echo $coms[$selcom]; ?>&nbsp;&nbsp;Seller:<?php echo $ags[$selagent]; ?>
	<br/>
	<font color="red" size="2"><b>(Click on IP to see an address for a world map, where your link was opened.)</b></font>
</div>
<div class="table-responsive">
<table class="table-sm w-100">
<thead class="bg-warning">
<tr class="text-black">
	<th><b><?php echo $this->ExPaginator->sort('ViewClickout.officename', 'Team', array('class' => 'text-reset')); ?></b></th>
	<th><b><?php echo $this->ExPaginator->sort('ViewClickout.username', 'Seller', array('class' => 'text-reset')); ?></b></th>
	<th><b><?php echo $this->ExPaginator->sort('ViewClickout.sitename', 'Site', array('class' => 'text-reset')); ?></b></th>
	<th><b><?php echo $this->ExPaginator->sort('ViewClickout.typename', 'Type', array('class' => 'text-reset')); ?></b></th>
	<!--<th><b>Link</b></th>-->
	<th><b><?php echo $this->ExPaginator->sort('ViewClickout.clicktime', 'Click Time', array('class' => 'text-reset')); ?></b></th>
	<th><b><?php echo $this->ExPaginator->sort('ViewClickout.fromip', 'IP From', array('class' => 'text-reset')); ?></b></th>
	<th <?php echo $userinfo['role'] == 0 ? '' : 'class="naClassHide"'; // HARD CODES?>>
		<b><?php echo $this->ExPaginator->sort('ViewClickout.referer', 'Referer', array('class' => 'text-reset')); ?></b>
	</th>
</tr>
</thead>
<?php
$i = 0;
foreach ($rs as $r):
?>
<tr <?php echo $i % 2 == 0 ? '' : 'class="odd"'; ?>>
	<td><?php echo $r['ViewClickout']['officename']; ?></td>
	<td><?php echo $r['ViewClickout']['username']; ?></td>
	<td><?php echo $r['ViewClickout']['sitename']; ?></td>
	<td><?php echo $r['ViewClickout']['typename']; ?></td>
	<!--<td>
	<?php
	/*
		if ($r['ViewClickout']['typename'] != '') {
			echo 'http://'. $_SERVER['HTTP_HOST']
				. $this->Html->url(array('controller' => 'accounts', 'action' => 'go'))
				. '/' . $r['ViewClickout']['siteid']
				. '/' . $r['ViewClickout']['typeid']
				. '/' . $r['ViewClickout']['username'];
		} else {
			echo '-';
		}
	*/
	?>
	</td>-->
	<td><?php echo $r['ViewClickout']['clicktime']; ?></td>
	<td>
		<a href="http://whatismyipaddress.com/ip/<?php echo $r['ViewClickout']['fromip']; ?>" target="findip_window">
			<?php echo $r['ViewClickout']['fromip']; ?>
		</a>
	</td>
	<td><?php echo $r['ViewClickout']['referer']; ?></td>
</tr>
<?php
$i++;
endforeach;
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

	jQuery(function() {
		jQuery('#datepicker_end').datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'
		});
	});

	var obj;
	obj = jQuery(".naClassHide");
	tbl = obj.parent().parent().parent();
	obj.each(function(i){
		idx = jQuery("th", obj.parent()).index(this);
		this.hide();
		jQuery("td:eq(" + idx + ")", jQuery("tr", tbl)).hide();
	});
});
</script>