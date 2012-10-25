<?=$this->Html->docType('html5')?>
<html>
	<head>
		<title><?=$title_for_layout?></title>
		<?=$this->fetch('css')?>
		<?=$this->fetch('script')?>
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
			</div>
			<div id="content">
			<?=$this->fetch('content')?>
			</div>
			<div id="footer">
			</div>
		</div>
	</body>
</html>