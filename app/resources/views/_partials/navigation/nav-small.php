<?php
	use NoxDocumentation\NoxDocumentation;
?>
<nav id="home-nav-small-bar">
	<div>
		<button type="button" id="home-small-nav-trigger-button">
			<span>Menu</span>
			<i class="bi bi-list"></i>
		</button>
	</div>
</nav>
<div id="home-nav-small-backdrop"></div>
<nav id="home-nav-small">
	<button type="button" id="home-small-nav-close-button">
		<i class="bi bi-x-circle-fill"></i>
	</button>
	<div class="logo-c">
		<img height="64" alt="Nox PHP framework logo" src="/images/logo-s.png">
	</div>
	<div class="links">
		<a href="/docs/2.0" title="Nox framework documentation">Documentation</a>
		<a href="/docs/2/installation" title="Introduction to the framework">Quick Start</a>
	</div>
	<div class="search-container">
		<form id="home-small-nav-search" action="/docs/2.0/search" method="get">
			<div id="home-small-nav-search-field-container">
				<label for="home-small-nav-search-input"><i class="bi bi-search"></i></label>
				<input name="query" type="text" id="home-small-nav-search-input" placeholder="Search docs">
			</div>
		</form>
	</div>
</nav>