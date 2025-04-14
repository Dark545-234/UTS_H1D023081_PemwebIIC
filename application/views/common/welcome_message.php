<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Index</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<?php $this->load->view('common/navbar'); ?>
<div class="container d-flex align-items-center justify-content-center mt-5">
	<div class="row">
    	<div class="col text-center">
			<!-- <h1>Welcome to Sistem Informasi Rumah Sakit Banget</h1>
			<p>Ini adalah halaman utama dari Sistem Informasi</p>
			<p>Masuk melalui tab halaman pada navbar</p>
			<p>Start your journey now</p> -->
			<?php if (!$this->session->userdata('user')): ?>
			<a href="<?= base_url('mahasiswa/loginPage') ?>"><button class="btn btn-primary m-2">Login</button></a>
			<a href="<?= base_url('mahasiswa/registrasi') ?>"><button class="btn btn-success m-2">Register</button></a>
			<?php else: ?>
			<p>Selamat Datang</p>
		
			<?php endif; ?>
		</div>
		</div>
	</div>
</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    <?php if($this->session->flashdata('success')): ?>
        alert("<?php echo $this->session->flashdata('success'); ?>");
    <?php elseif($this->session->flashdata('error')): ?>
        alert("<?php echo $this->session->flashdata('error'); ?>");
    <?php endif; ?>
    </script>
</body>
</html>
