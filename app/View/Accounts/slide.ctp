<?php
$file = @fopen('/var/www/html/uploads/sellers_get_paid.txt','r');
$content = array();
if(!$file){
	return 'file open fail';
}else{
	$i = 0;
	while (!feof($file)){
		$content[$i] = mb_convert_encoding(fgets($file),"UTF-8","GBK,ASCII,ANSI,UTF-8");
		$content[$i] = trim($content[$i]);
		$i++ ;
	}
	fclose($file);
	$content = array_filter($content); //remove empty ones
	$content = array_values($content); //re-oder from 0
}

$len = count($content);
$top = floor($len / 3);
$pickone = (rand(1, $top) - 1) * 3;
?>
<div style="text-decoration:underline;width:100%;margin:0;font-weight:bold;color:black;">
<?php echo $content[$pickone]; ?>
</div>
<div style="width:100%;font-size:12px;margin:0;">
<?php echo $content[$pickone + 1]; ?>
</div>
<div style="width:100%;font-size:12px;margin:0;">
<?php echo $content[$pickone + 2]; ?>
</div>