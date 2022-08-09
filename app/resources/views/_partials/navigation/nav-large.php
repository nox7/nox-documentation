<?php
	use NoxDocumentation\NoxDocumentation;
?>
<nav id="home-nav">
	<div class="logo-c">
		<a href="/" title="Website home page">
			<img height="64" alt="Nox PHP framework logo" src="/images/logo-s.png">
		</a>
	</div>
	<div class="links">
		<a href="/" title="Website home page">Home</a>
		<a href="/docs/2.0" title="Nox framework documentation">Documentation</a>
		<a href="/docs/2.0/installation" title="Introduction to the framework">Quick Start</a>
		<a target="_blank" href="https://github.com/nox7/nox" title="GitHub repository for Nox">
			<i class="bi bi-github pe-2"></i>
			<span>GitHub</span>
		</a>
	</div>
	<div class="search-container">
		<form id="home-top-search" action="/docs/<?= NoxDocumentation::CURRENT_MAJOR_VERSION ?>/search" method="get">
			<div id="home-top-search-field-container">
				<label for="home-top-search-input"><i class="bi bi-search"></i></label>
				<input name="query" type="text" id="home-top-search-input" placeholder="Search docs">
			</div>
		</form>
	</div>
</nav>