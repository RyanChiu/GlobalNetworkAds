<?php
//echo print_r($rs, true);
App::import('Vendor', 'extrakits');
$userinfo = $this->Session->read('Auth.User.Account');
?>
<!--  
<small>(You're from:<?php //echo __getclientip(); ?>, and you'll be <?php //echo __isblocked(__getclientip()) ? 'blocked.' : 'passed.'; ?>)</small>
-->
<?php
echo $this->Form->create(null, array('url' => array('controller' => 'links', 'action' => 'lstlinks')));
?>
<table class="table-sm w-100 table-borderless">
<tr><td>
	<div class="container-fluid float-left p-0">
	<?php
	if ($userinfo['role'] == 0) {//means an administrator
		echo $this->Html->link(
			'Config Sites...',
			array('controller' => 'links', 'action' => 'lstsites')
		);
	}
	?>
	</div>
	<?php
	if (!empty($suspsites)) {
	?>
	<div class="container-fluid text-danger">
	<?php
		echo '>>Site "' . implode(",", $suspsites) . '"' . (count($suspsites) > 1 ? ' are' : ' is')
			. ' suspended for now.';
	?>
	</div>
	<?php
	}
	?>
</td></tr>
<tr><td>
	<div class="form-row">
		<div class="form-inline">
			<div class="col">
			<?php
			echo $this->Form->input('Site.id',
				array(
					'options' => $sites, 
					'class' => 'form-contorl', 
					'label' => '', 
					'type' => 'select'
				)
			);
			?>
			</div>
			<div class="col">
				<b>Site</b>
			</div>
		</div>
		<div class="form-inline">
			<div class="col">
			<?php
			echo $this->Form->input('ViewAgent.id',
				array(
					'options' => $sags, 
					'class' => 'form-contorl', 
					'label' => '', 
					'type' => 'select')
			);
			?>
			</div>
			<div class="col">
				<b>Seller</b>
			</div>
		</div>
		<div class="form-inline">
		<?php
		echo $this->Form->submit('Generate Link', 
			array(
				'class' => 'btn btn-sm btn-secondary text-light ml-3'
			)
		);
		?>
		</div>
	</div>
</td></tr>
</table>
<?php
echo $this->Form->end();
?>

<?php
if (!empty($rs)) {
?>
	<div class="table-responsive">
	<table class="w-100 table-contensed table-borderless">
	<?php
	foreach ($rs as $r):
		if (array_key_exists('ViewLink', $r)) {
	?>
		<tr>
			<td align="center">
			<?php
			echo $r['ViewLink']['sitename'] . '_' . $r['ViewLink']['typename'] . ':&nbsp;&nbsp;&nbsp;';
			echo '<b>';
			echo $this->Html->url(
				array('controller' => 'accounts', 'action' => 'golink',
					'to' => __codec($r['ViewLink']['id'] . ',' . $r['ViewLink']['agentid'], 'E')
				),
				true
			);
			echo '</b>';
			?>
			</td>	
		</tr>
	<?php
		} else if (array_key_exists('AgentSiteMapping', $r)) {
			$i = 0;
			foreach ($types as $type) {
	?>
		<tr>
			<td>
				<div class="container-fluid w-100 row">
					<?php
					echo $sites[$r['AgentSiteMapping']['siteid']] 
						. '_' . $type['ViewType']['typealias'] 
						. ':';
					?>
				</div>
				<div class="container-fluid w-100 row">
					<?php
					echo '<b>';
					echo $this->Html->url(array('controller' => 'accounts', 'action' => 'go'), true) . '/'
						. $r['AgentSiteMapping']['siteid'] . '/'
						. $type['ViewType']['id']. '/'
						. $ags[$r['AgentSiteMapping']['agentid']];
					echo '</b>';
					?>
				</div>
			</td>
		</tr>
	<?php
			$i++;
			}
		}
	endforeach;
	?>
	</table>
	</div>
<?php
}
?>
