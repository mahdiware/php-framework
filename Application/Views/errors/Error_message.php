<!DOCTYPE html>
<html>
<head>
	<title>Error</title>
	<style type="text/css">
		body {
			background-color: #f9f9f9;
			font-family: Arial, Helvetica, sans-serif;
			color: #333;
			margin: 0;
			padding: 0;
			font-size: 16px;
		}

		.container {
			margin: 50px auto;
			max-width: 600px;
			padding: 20px;
			background-color: #fff;
			box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
		}

		h1 {
			font-size: 24px;
			margin-bottom: 20px;
		}

		p {
			margin-top: 0;
			line-height: 1.5;
		}

		code {
			background-color: #f5f5f5;
			padding: 2px 5px;
			border-radius: 3px;
		}

	</style>
</head>
<body>
	<div class="container">
		<h1>Oops, something went wrong!</h1>
		<p>We&#039;re sorry, but there was an error processing your request. The error message is:</p>
		<code><?php echo $getError; ?></code>
		<p>Please try again later or contact customer support if the problem persists.</p>
	</div>
</body>
</html>
