<?php
	namespace NoxDocumentation\Docs;

	#[\Attribute(\Attribute::TARGET_METHOD)]
	class DocumentationFilePath{
		public function __construct(
			public string $filePath,
		){}
	}