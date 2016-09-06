<html>
<head>
	<title>
		O2System Gears
	</title>

	<link rel="stylesheet" href="<?php echo $assetsURL; ?>fonts/ubuntu/ubuntu.css">

	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?php echo $assetsURL; ?>packages/bootstrap/bootstrap.css">

	<!-- SyntaxHighlighter -->
	<link href="<?php echo $assetsURL; ?>packages/highlighter/highlighter.css" rel="stylesheet" type="text/css" />

	<!-- Font Icon CSS -->
	<link rel="stylesheet" href="<?php echo $assetsURL; ?>fonts/font-awesome/font-awesome.css">

	<style type="text/css">
		body {
			font-family: 'Ubuntu', Segoe, "Segoe UI", "DejaVu Sans", "Trebuchet MS", Verdana, sans-serif;
			font-size: 12px;
		}

		.wrapper {
			width: 100%;
			height: auto;
			min-height: 100%;
		}

		.row {
			margin: 0;
		}

		a:focus {
			outline: none;
		}

		input[type="file"]:focus, input[type="checkbox"]:focus, input[type="radio"]:focus {
			outline: none;
		}

		.form-horizontal .checkbox, .form-horizontal .checkbox-inline, .form-horizontal .radio, .form-horizontal .radio-inline {
			padding-top: 0;
		}

		form {
			margin: 0;
		}

		.btn {
			margin-left: 8px;
			cursor: hand;
			text-transform: uppercase;
		}

		.btn-blue {
			background: #058ca6;
			color: #fff;
		}

		.btn-blue:hover, .btn-blue:focus {
			background: #0396b2;
			color: #fff;
		}

		.btn-darkblue {
			background: #07485e;
			color: #fff;
		}

		.btn-darkblue:hover, .btn-darkblue:focus {
			background: #07526b;
			color: #fff;
		}

		.panel {
			margin-bottom: 0;
		}

		.panel-default > .panel-heading {
			background: #fff;
			color: #333;
			padding: 5px 0px;
		}

		.panel, .panel-heading {
			border-radius: 0;
			border: none;
		}

		.panel-heading a, .panel-heading a:hover, .panel-heading a:focus {
			color: #a94442;
			text-decoration: none;
		}

		.panel-body {
			padding: 10px;
			background-color: #f6f6f6;
		}

		.panel-danger .panel-body {
			padding: 15px;
			padding-bottom: 0;
		}

		pre {
			font-family: 'Ubuntu', Segoe, "Segoe UI", "DejaVu Sans", "Trebuchet MS", Verdana, sans-serif;
			border-radius: 0;
			margin: 0;
		}

		.img-logo {
			margin-left: 0px;
		}

		.mtop-5 {
			margin-top: 5px;
		}

		.modal-dialog {
			width: 100%;
			height: 100%;
			padding: 0;
			margin: 0;
		}

		.syntaxhighlighter {
			padding: 10px;
		}

		.index0 > .spaces {
			display: none;
		}
	</style>
</head>
<body>
<div class="wrapper">
	<div class="row">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<a data-toggle="collapse" href="#tracer">
					<h3 class="panel-title" style="text-transform:uppercase">Profiler</h3>
				</a>
			</div>

			<div class="panel-body">
				<table class="table table-striped table-bordered table-list">
					<tbody>
					<?php foreach($backtrace as $marker => $log): ?>
						<tr class="success">
							<td><?php echo $log['time']; ?></td>
							<td><?php echo $marker; ?></td>
							<td><?php echo $log['memory']; ?></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<div class="panel-footer">
                <span style="color:#666"><i class="fa fa-clock-o"></i> 1.0014978008954 seconds / <i
		                class="fa fa-dashboard"></i> 0.6798 MB</span>
			</div>
		</div>
	</div>
</div>

<!-- Include jQuery -->
<script type="text/javascript" src="<?php echo $assetsURL; ?>js/jquery.js"></script>

<!-- Include Bootstrap -->
<script type="text/javascript" src="<?php echo $assetsURL; ?>packages/bootstrap/bootstrap.js"></script>
</body>

