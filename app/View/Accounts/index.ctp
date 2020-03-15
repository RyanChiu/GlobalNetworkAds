<?php
//echo print_r($rs, true);
$userinfo = $this->Session->read('Auth.User.Account');
?>
<?php
//echo $this->element('timezoneblock');
?>
<div class="table-responsive">
<table class="w-100">
<!-- <tr class="odd"> -->
<tr>
	<td>
	<div class="m-2">
	<?php
	//echo $this->Html->image('iconTopnotes.png');
	//echo '<b><font size="3">News</font></b>';
	echo /*'<br/>' . */$topnotes;
	?>
	<div style="height:6px"></div>
	</div>
	</td>
</tr>
<?php
if (!empty($notes)) {
?>
<tr>
	<td>
	<div style="margin:5px 20px 5px 20px;">
	<?php
	//echo $this->Html->image('iconAttention.png');
	echo '<br/>' . $notes . '<br/><div style="height:6px"></div>';
	?>
	</div>
	</td>
</tr>
<?php 
}
?>
</table>
</div>

<!-- show the top selling list -->
<?php
if (true) {
?>
<br/>
<div><font size="5" color="#bb2222">Best sellers</font></div>
<table style="width:100%">
<tr>
	<td colspan=2>
		<div class="float-left">
		(From <?php echo $weekstart; ?> To <?php echo $weekend; ?>)
		</div>
		<div style="float: right;">
		<?php
		if ($userinfo['role'] == 0) {
			echo $this->Html->link('<font size="2">Choose another pay period or another month</font>',
				array('controller' => 'accounts', 'action' => 'top10'),
				array('escape' => false),
				false
			);
		}
		?>
		</div>
	</td>
</tr>
<tr>
	<td width="50%">
		<div style="font-style:italic;">
		<font style="font-weight:bold;color:red;">WEEKLY TOP 10 AGENTS</font>		
		</div>
		<div class="table-responsive pr-3">
		<table class="table-condensed table-bordered w-100 mb-1">
		<thead>
		<tr class="totals text-left">
			<th>Rank</th>
			<th>Office</th>
			<th>Agent</th>
			<th>Sales</th>
		</tr>
		</thead>
		<?php
		$i = 0;//debug($weekrs);debug($rs);
		if (!empty($weekrs)) {
			foreach ($weekrs as $r) {
				$i++;
		?>
			<tr class="text-left">
				<td><?php echo $i; ?></td>
				<td style="font-size:8pt;">
					<?php echo $r['Top10']['sales'] > 0 ? $r['Top10']['officename'] : $r['Top10']['officename']; ?>
				</td>
				<td>
					<font style="font-size: 9pt;"><?php echo $r['Top10']['username']; ?></font>
					<font style="font-size: 10pt;"> (<?php echo $r['Top10']['ag1stname'] ?>)</font>
				</td>
				<td><?php echo $r['Top10']['sales'] > 0 ? $r['Top10']['sales'] : '0'; ?></td>
			</tr>
		<?php
			}
		}
		?>
		</table>
		</div>
	</td>
	<td>
		<div class="pl-3" style="font-style:italic;">
		<font style="font-weight:bold;color:red;">WEEKLY SALES PER OFFICE</font>	
		</div>
		<div class="table-responsive pl-3">
		<table class="table-condensed table-bordered w-100 mb-1">
		<thead>
		<tr class="totals text-left">
			<th>Rank</th>
			<th>Office</th>
			<th>Sales</th>
		</tr>
		</thead>
		<?php
		$i = 0;
		if (!empty($weekrs_offi)) {
			foreach ($weekrs_offi as $r) {
				$i++;
		?>
			<tr class="text-left">
				<td><?php echo $i; ?></td>
				<td style="font-size:8pt;">
					<?php echo $r['Top10']['sales'] > 0 ? $r['Top10']['officename'] : $r['Top10']['officename']; ?>
				</td>
				<td><?php echo $r['Top10']['sales'] > 0 ? $r['Top10']['sales'] : '0'; ?></td>
			</tr>
		<?php
			}
		}
		?>
		</table>
		</div>
	</td>
</tr>
<!--
<tr>
	<td colspan=2>
	<div class="float-left">
	(Start from 2016-08-14)
	</div>
	</td>
</tr>
<tr>
	<td width="50%">
		<div style="font-style:italic;">
			<font style="font-weight:bold;color:#0066dd;">ALL THE TIME</font>
		</div>
		<div class="table-responsive">
		<table class="table-condensed table-bordered w-100 mb-1">
		<thead>
		<tr class="totals text-center">
			<th>Rank</th>
			<th>Office</th>
			<th>Agent</th>
			<th>Sales</th>
		</tr>
		</thead>
		<?php
		$i = 0;
		foreach ($rs as $r) {
			$i++;
		?>
		<tr <?php echo $i <= 3 ? 'style="font-weight:bold;"' : ''; ?>>
			<td align="center"><?php echo $i; ?></td>
			<td align="center"><?php echo $r['Top10']['sales'] > 0 ? $r['Top10']['officename'] : $r['Top10']['officename']; ?></td>
			<td align="center">
				<font style="font-size: 9pt;">
				<?php
				echo $r['Top10']['sales'] > 0 ? $r['Top10']['username'] : $r['Top10']['username'];
				?>
				</font>
				<font style="font-size: 10pt;">(
				<?php
				//$showname = $r['Top10']['ag1stname'] . " " . $r['Top10']['aglastname'];
				$showname = $r['Top10']['ag1stname'];
				echo strlen($showname) > 20 ? (substr($showname, 0, 17) . "...") : $showname;
				?>
				)</font>
			</td>
			<td align="center"><?php echo $r['Top10']['sales'] > 0 ? $r['Top10']['sales'] : '0'; ?></td>
		</tr>
		<?php
		}
		?>
		</table>
		</div>
	</td>
	<td>
		<div style="font-style:italic;">
		<font style="font-weight:bold;color:#0066dd;">ALL TIME TOP 10 AGENTS</font>
		</div>
		<div class="table-responsive">
		<table class="table-condensed table-bordered w-100 mb-1">
		<thead>
		<tr class="totals text-center">
			<th>Rank</th>
			<th>Office</th>
			<th>Agent</th>
			<th>Sales</th>
		</tr>
		</thead>
		<?php
		$i = 0;
		if (!empty($rs)) {
			foreach ($rs as $r) {
				$i++;
		?>
			<tr>
				<td align="center"><?php echo $i; ?></td>
				<td align="center" style="font-size:8pt;">
					<?php echo $r['Top10']['sales'] > 0 ? $r['Top10']['officename'] : $r['Top10']['officename']; ?>
				</td>
				<td align="center">
					<font style="font-size: 9pt;"><?php echo $r['Top10']['username']; ?></font>
					<font style="font-size: 10pt;"> (<?php echo $r['Top10']['ag1stname'] ?>)</font>
				</td>
				<td align="center"><?php echo $r['Top10']['sales'] > 0 ? $r['Top10']['sales'] : '0'; ?></td>
			</tr>
		<?php
			}
		}
		?>
		</table>
		</div>
	</td>
</tr>
-->
</table>
<?php
}
?>

<!-- ## for accounts overview
<table style="width:100%">
<caption>All Accounts Overview</caption>
<thead>
<tr>
	<th width="20%"><b></b></th>
	<th width="40%"><b>Office</b></th>
	<th width="40%"><b>Agent</b></th>
</tr>
</thead>
<tr>
	<td>Onlines</td>
	<td><?php echo $totals['cponlines']; ?></td>
	<td><?php echo $totals['agonlines']; ?></td>
</tr>
<tr class="odd">
	<td>Offlines</td>
	<td><?php echo $totals['cpofflines']; ?></td>
	<td><?php echo $totals['agofflines']; ?></td>
</tr>
<tr>
	<td>Activated</td>
	<td><?php echo $totals['cpacts']; ?></td>
	<td><?php echo $totals['agacts']; ?></td>
</tr>
<tr class="odd">
	<td>Suspended</td>
	<td><?php echo $totals['cpsusps']; ?></td>
	<td><?php echo $totals['agsusps']; ?></td>
</tr>
</table>

<table style="width:100%">
<caption>Online Accounts Overview</caption>
<thead>
<tr>
	<th width="15%"><b>Online Username</b></th>
	<th width="25%"><b>Office Name</b></th>
	<th width="25%"><b>Contact Name</b></th>
	<th width="20%"><b>Registered</b></th>
</tr>
</thead>
<?php
$i = 0;
foreach ($cprs as $cpr):
?>
<tr <?php echo $i % 2 == 0 ? '' : 'class="odd"'; ?>>
	<td>
	<?php
	echo $this->Html->image('iconCompany_small.png', array('width' => 16, 'height' => 16, 'border' => 0, 'title' => 'It\'s a company'));
	echo $cpr['ViewCompany']['username'];
	?>
	</td>
	<td><?php echo $cpr['ViewCompany']['officename']; ?></td>
	<td><?php echo $cpr['ViewCompany']['contactname']; ?></td>
	<td><?php echo $cpr['ViewCompany']['regtime']; ?></td>
</tr>
<?php
	$i++;
endforeach;
?>
<?php
$i = 0;
foreach ($agrs as $agr):
?>
<tr <?php echo $i % 2 == 0 ? '' : 'class="odd"'; ?>>
	<td>
	<?php
	echo $this->Html->image('iconAgent_small.png', array('width' => 16, 'height' => 16, 'border' => 0, 'title' => 'It\'s an agent'));
	echo $agr['ViewAgent']['username'];
	?>
	</td>
	<td><?php echo $agr['ViewAgent']['officename']; ?></td>
	<td><?php echo $agr['ViewAgent']['name']; ?></td>
	<td><?php echo $agr['ViewAgent']['regtime']; ?></td>
</tr>
<?php
	$i++;
endforeach;
?>
</table>
-->