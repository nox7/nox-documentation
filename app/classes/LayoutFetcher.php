<?php

	class LayoutFetcher
	{
		/**
		 * Fetches available layout file names from nox.json
		 * The returned file paths are relative to the app root
		 */
		public static function getAvailableLayoutFilePaths(): array{
			$noxJSON = __DIR__ . "/../nox.json";
			$appRoot = realpath(__DIR__ . "/..");
			$serverRoot = realpath(__DIR__ . "/../..");
			$noxConfig = json_decode(file_get_contents($noxJSON), true);
			$layoutsFolderRelativeToAppRoot = $noxConfig['layouts-directory'];
			$layoutDirectoryHandle = opendir(sprintf("%s/%s", $appRoot, $layoutsFolderRelativeToAppRoot));
			$layoutFilePaths = [];

			$relativeAppRootPath = str_replace($serverRoot, "", $appRoot);

			// TODO Eventually handle nested folders?
			// If that ever becomes a thing in Nox
			do{
				$fileName = readdir($layoutDirectoryHandle);
				if ($fileName !== false){
					if ($fileName !== "." && $fileName !== ".."){
						$fullPathToLayoutFile = realpath(
							sprintf("%s%s/%s",
								$appRoot,
								$layoutsFolderRelativeToAppRoot,
								$fileName,
							),
						);
						$relativePathFromAppRoot = str_replace($appRoot, "", $fullPathToLayoutFile);
						$layoutFilePaths[] = $relativePathFromAppRoot;
					}
				}
			}while($fileName !== false);

			return $layoutFilePaths;
		}
	}