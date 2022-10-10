<?php

	require_once __DIR__ . "/../app/nox-env.php";
	require_once __DIR__ . "/../vendor/autoload.php";

	use NoxDocumentation\Docs\DocsVersions;
	use NoxDocumentation\Docs\SearchService;
	use PHPUnit\Framework\TestCase;

	final class SearchDocsTest extends TestCase
	{

		public static function setUpBeforeClass(): void{
			$nox = new Nox\Nox();
			$nox->setSourceCodeDirectory(__DIR__ . "/../app/src");
		}

		public function testSearchDocsV2(): void
		{
			// Currently, there are only two documents that reference $viewScope. If there are ever more, this
			// test needs to be updated.
			$reflectionMethods = SearchService::query(DocsVersions::_2_0->value, "\$viewScope");

			$this->assertNotEmpty($reflectionMethods);
			$this->assertCount(2, $reflectionMethods);
		}
	}