<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $title ?></title>
    
	<?= $this->renderSection('css') ?>
	
	<?= $this->renderSection('js') ?>
</head>
<body class="grey lighten-3">
	
	<?= $this->renderSection('content') ?>
	
</body>
</html>