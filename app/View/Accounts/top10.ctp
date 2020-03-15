<div class="container-fluid row w-100">

<?php debug($rs);
echo $this->Form->create(
	null, 
	array(
		'url' => array('controller' => 'accounts', 'action' => 'top10'), 
		'id' => 'frmTop10'
	)
);
?>
	<div class="form-row mb-1">
		<div class="form-inline mt-1">
			<div class="col">
			<?php
			echo $this->Form->input('Top10.period',
				array(
					'id' => 'selPeriod',
					'label' => '', 'type' => 'select',
					'options' => $periods,
					'selected' => isset($start)? ($start . ',' . $end) : null,
					'class' => 'form-contorl',
					'style' => 'width:236px;'
				)
			);
			?>
			</div>
			<div class="col">
			<?php
			echo $this->Form->submit('>>', array('class' => 'btn btn-sm btn-secondary'));
			?>
			</div>
		</div>
	</div>
<?php
if (!empty($rs)) {
?>
	<div class="container-fluid row w-100">
		<div class="container-fluid row w-100">
			The Period (From <?php echo $start; ?> To <?php echo $end; ?>)
		</div>
		<div class="table-responsive">
		<table class="table-sm table-bordered table-condensed w-100 mb-1">
		<thead class="totals">
			<tr>
				<th>Top NO.</th>
				<th>Office</th>
				<th>Agent</th>
				<th>Total Sales</th>
			</tr>
			</thead>
			<?php
			$i = 0;
			foreach ($rs as $r) {
				$i++;
			?>
			<tr <?php echo $i <= 3 ? 'style="font-weight:bold;"' : ''; ?>>
				<td align="center"><?php echo $i; ?></td>
				<td align="center"><?php echo $r[0]['sales'] > 0 ? $r['Top10Stats']['officename'] : ''; ?></td>
				<td align="center"><?php echo $r[0]['sales'] > 0 ? $r['Top10Stats']['username'] : ''; ?></td>
				<td align="center"><?php echo $r[0]['sales'] > 0 ? $r[0]['sales'] : ''; ?></td>
			</tr>
			<?php
			}
			?>
		</table>
		</div>
	</div>
	<div style="display:none">
	<?php echo $this->Form->submit('go', array('id' => 'iptSubmit'));?>
	</div>
<?php
}
echo $this->Form->input('Top10.start', array('type' => 'hidden', 'id' => 'iptStart', 'value' => isset($start) ? $start : 0));
echo $this->Form->input('Top10.end', array('type' => 'hidden', 'id' => 'iptEnd', 'value' => isset($end) ? $end : 0));
echo $this->Form->end();
?>
</div>

<script type="text/javascript">
jQuery("#selPeriod").change(function() {
	__zSetFromTo("selPeriod", "iptStart", "iptEnd");
});
</script>