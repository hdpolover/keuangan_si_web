<!DOCTYPE html>
<html lang="en" dir="">

<head>

    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Meta Website -->
	<meta name="description" content="<?= $web_desc; ?>">
	<meta property="og:title" content="<?= ($this->uri->segment(1) ? ucwords(str_replace('-', ' ', $this->uri->segment(1)) . ' ' . ($this->uri->segment(2) ? str_replace('-', ' ', $this->uri->segment(2)) : "") . $web_title) : $web_title); ?>">
	<meta property="og:description" content="<?= $web_desc; ?>">
	<meta property="og:image" content="<?= base_url(); ?>assets/images/<?= $web_icon?>">
	<meta property="og:url" content="<?= base_url(uri_string()) ?>">
    
    <title><?= ($this->uri->segment(1) ? ucwords(str_replace('-', ' ', $this->uri->segment(1)) . ' ' . ($this->uri->segment(2) ? str_replace('-', ' ', $this->uri->segment(2)) : "") . " - ".$web_title) : $web_title); ?></title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/<?= $web_icon;?>">

	<!-- Styles -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
	<link href="<?= base_url();?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url();?>assets/plugins/font-awesome/css/all.min.css" rel="stylesheet">
	<link href="<?= base_url();?>assets/plugins/waves/waves.min.css" rel="stylesheet">
	<link href="<?= base_url();?>assets/plugins/nvd3/nv.d3.min.css" rel="stylesheet">
	
	<!-- Theme Styles -->
	<link href="<?= base_url();?>assets/css/alpha.min.css" rel="stylesheet">

    <!-- datatables -->
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <!-- stylesheet -->
    <link href="<?= base_url();?>assets/css/custom.css" rel="stylesheet">

    <!-- javascript -->
    <script type="text/javascript" src="<?= base_url();?>assets/js/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="<?= base_url();?>assets/plugins/bootstrap/popper.min.js"></script>
	<script type="text/javascript" src="<?= base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!-- sweetalert2 -->
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- data tables -->
	<script type="text/javascript" src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="//cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

	<script type="text/javascript" src="<?= base_url();?>assets/plugins/waves/waves.min.js"></script>
	<script type="text/javascript" src="<?= base_url();?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script type="text/javascript" src="<?= base_url();?>assets/plugins/d3/d3.min.js"></script>
	<script type="text/javascript" src="<?= base_url();?>assets/plugins/nvd3/nv.d3.min.js"></script>
	<script type="text/javascript" src="<?= base_url();?>assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
	<script type="text/javascript" src="<?= base_url();?>assets/plugins/apexcharts/dist/apexcharts.min.js"></script>
	<script type="text/javascript" src="<?= base_url();?>assets/plugins/flot/jquery.flot.min.js"></script>
	<script type="text/javascript" src="<?= base_url();?>assets/plugins/flot/jquery.flot.time.min.js"></script>
	<script type="text/javascript" src="<?= base_url();?>assets/plugins/flot/jquery.flot.symbol.min.js"></script>
	<script type="text/javascript" src="<?= base_url();?>assets/plugins/flot/jquery.flot.resize.min.js"></script>
	<script type="text/javascript" src="<?= base_url();?>assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
</head>
<body>
	<div class="loader">
		<div class="spinner-border text-primary" role="status">
			<span class="sr-only">Loading...</span>
		</div>
	</div>