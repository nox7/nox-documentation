<?php

?>
<nav id="nav-small-bar" class="docs">
	<div>
		<button type="button" id="small-nav-docs-drawer-trigger-button">
			<i class="bi bi-list"></i>
			<span>Docs</span>
		</button>
	</div>
	<div>
		<button type="button" id="small-nav-trigger-button">
			<span>Menu</span>
			<i class="bi bi-list"></i>
		</button>
	</div>
</nav>
<div id="nav-small-backdrop"></div>
<nav id="nav-small">
	<button type="button" id="small-nav-close-button">
		<i class="bi bi-x-circle-fill"></i>
	</button>
	<div class="logo-c">
		<img height="64" alt="Nox PHP framework logo" src="/images/logo-s.png">
	</div>
	<div class="links">
		<a href="/" title="Home page">Home</a>
		<a href="/docs/2.0" title="Nox framework documentation">Documentation</a>
		<a href="/docs/2.0/installation" title="Introduction to the framework">Quick Start</a>
		<a href="https://github.com/nox7/nox" title="GitHub repository">
			<i class="bi bi-github pe-2"></i>
			<span>GitHub</span>
		</a>
	</div>
	<div class="search-container">
		<form id="small-nav-search" action="/docs/2.0/search" method="get">
			<div id="small-nav-search-field-container">
				<label for="small-nav-search-input"><i class="bi bi-search"></i></label>
				<input name="query" type="text" id="small-nav-search-input" placeholder="Search docs">
			</div>
		</form>
	</div>
</nav>