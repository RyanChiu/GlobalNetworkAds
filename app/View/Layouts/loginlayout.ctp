<!doctype html>
<html lang="en">
<head>
<title><?php echo $title_for_layout; ?>
</title>
<?php
echo $this->Html->meta('icon', $this->Html->url('/../favicon.ico'));

/*for bootstrap 3*/
echo $this->Html->css('../bootstrap4.3.1/css/bootstrap.min');
echo $this->Html->script('jquery-3.3.1.min');
echo $this->Html->script('popper.min');
//echo $this->Html->script('../bootstrap4.3.1/js/bootstrap.bundle.min');
echo $this->Html->script('../bootstrap4.3.1/js/bootstrap.min');

echo $this->Html->css("mine");

echo $scripts_for_layout;

?>
</head>
<body style="background:black;">
<div class="container-fluid p-0 zMaxWidth">
	<div class="container-fluid bg-black" style="min-height:18px;"></div>
	<div class="container-fluid bg-black" style="min-height:8px;"></div>
	<div class="container-fluid text-center bg-black">
		<div class="w-100">
			<?php 
			echo $this->Html->image(
				'HEADER.jpg', 
				array(
					'class' => 'img-fluid'
				)
			);
			?>
		</div>
	</div>
	<div class="container-fluid" style="min-height:10px;"></div>
	<div class="container-fluid">
		<div style="text-align:center">
			<b><font color="red"><?php echo $this->Session->flash(); ?></font> </b>
		</div>
	</div>
	<div class="container-fluid">
		<?php echo $content_for_layout; ?>
	</div>
	<div class="container-fluid zMaxWidth px-0 py-3 mt-2 bg-black text-white">
		<center>
			Alexanderplatz Gontard  Strasse 11  Berlin Deutschland EU 
			Copyright &copy; 2020 All Rights, Reserved.<BR/>
			<a href="Https://www.WeFeedPinoy.com">Https://www.WeFeedPinoy.com</a> 
			<br/> 
		</center>
	</div>
	<div class="container-fluid bg-black" style="min-height:1px;"></div>
	<div class="container-fluid bg-black" style="min-height:18px;"></div>
</div>
</body>
</html>
