<html>
	<?php 
	$codename = "123123123";
	?>
<head>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="jquery-barcode.js"></script>
</head>
<body>

<div id="bcTarget"></div>
</body>

<script type="text/javascript">
    $("#bcTarget").barcode("<?php echo $codename; ?>", "codabar");
</script>

</html>