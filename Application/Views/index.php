<?= $this->extend('layouts/layout') ?>
<!-- extend is added to all subsequent html -->

<!-- function section() and the endSection() named css are added to the data in the extend() which defines the before in renderSection -->
<?= $this->section('css') ?>
	
	<!-- The Storage function looks for files in the Storage Folder in the foreground -->
	<link type="text/css" href="<?= Storage('assets/css/style.css') ?>" rel="stylesheet">
	
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<main>
	<header>
    	<div class="heroe">
        	<h1>Welcome to <?= env('developer.name') ?> <?= Mahdiware\Mahdiware::VERSION ?></h1>
        	<h2>The small framework with powerful features</h2>
    	</div>
	</header>

	<section>
    	<h1>About this page</h1>
    	<p>The page you are looking at is being generated dynamically by <?= env('developer.name') ?>.</p>
    	<p>If you would like to edit this page you will find it located at:</p>
    	<pre><code>Application/Views/index.php</code></pre>
    	<p>The corresponding controller for this page can be found at:</p>
    	<pre><code>Application/Controllers/Home.php</code></pre>
	</section>
</main>

<footer>
	<div class="center-block" style="padding: 15px">
    	<a class="text-muted" href="<?= env('chat.telegram') ?>">&copy; <?= env('developer.name') ?> Team 2022 - <?= date('Y') ?></a>
	</div>
</footer>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
	<!--<script src="assets/js/example.js" ></script>-->
<?= $this->endSection() ?>