<?php
	namespace NoxDocumentation\Docs;

	#[\Attribute(\Attribute::TARGET_CLASS)]
	class SetDocVersion{

		public function __construct(
			public string $version,
		){
			DocsVersion::$currentPageVersion = $version;
		}
	}