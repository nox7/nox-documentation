<?php
	namespace Utils\PageSearch;

	class EligibleRoute{
		public function __construct(
			public string $uri,
			public string $title,
			public string $body,
		){}
	}