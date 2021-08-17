<?php

	require_once __DIR__ . "/../../classes/Page.php";

	use Nox\Http\Rewrite;
	use Nox\RenderEngine\Renderer;
	use Nox\Router\Attributes\Route;
	use Nox\Router\Attributes\RouteBase;

	#[RouteBase("/admin")]
	class EditorController extends \Nox\Router\BaseController{

		#[Route("GET", "/editor")]
		#[Route("GET", "/\/editor\/(?<pageID>\d+)/", true)]
		public function editorMain(): string|Rewrite{

			$editedPage = null;
			if (isset($_GET['pageID'])){
				$abyss = new \Nox\ORM\Abyss();

				/** @var Page $page */
				$editedPage = $abyss->fetchInstanceByModelPrimaryKey(
					model:Page::getModel(),
					keyValue: $_GET['pageID'],
				);

				if ($editedPage === null){
					// 404
					return new Rewrite("/404", 404);
				}
			}

			return Renderer::renderView(
				viewFileName: "editor/main.php",
				viewScope: [
					"pageBeingEdited"=>$editedPage,
				],
			);
		}

		#[Route("POST", "/editor")]
		public function createPage(): string{

			$request = new \Nox\Http\Request();
			$response = new \Nox\Http\Response();
			$response->setJSONHeaders();

			$pageTitle = $request->getPostValue("page-title", "");
			$pageCategoryID = (int) $request->getPostValue("page-category", -1);
			$pageRoute = $request->getPostValue("page-route", "");
			$pageBody = $request->getPostValue("page-body", "");
			$pageLayoutFilePath = $request->getPostValue("page-layout-file-path", "");
			$pageHead = $request->getPostValue("page-head", "");

			if (empty($pageTitle)){
				return $response->getJsonError("Enter a page title");
			}

			if (empty($pageRoute)){
				return $response->getJsonError("Enter a page route");
			}

			if ($pageCategoryID === -1){
				$pageCategoryID = null;
			}

			$page = new Page();
			$page->categoryID = $pageCategoryID;
			$page->pageLayoutFilePath = $pageLayoutFilePath;
			$page->title = $pageTitle;
			$page->route = $pageRoute;
			$page->body = $pageBody;
			$page->head = $pageHead;
			$page->save();
			$pageID = $page->id;

			return $response->getJsonSuccess([
				"newPageEditorURI"=>"/admin/editor/" . $pageID,
			]);
		}

		#[Route("PATCH", "/\/editor\/(?<pageID>\d+)/", true)]
		public function savePage(): string{

			$request = new \Nox\Http\Request();
			$response = new \Nox\Http\Response();
			$_PATCH = $request->processRequestBody();
			$response->setJSONHeaders();

			$pageID = (int) $_GET['pageID'];
			$pageTitle = $_PATCH['page-title'];
			$pageCategoryID = (int) $_PATCH['page-category'];
			$pageRoute = $_PATCH['page-route'];
			$pageBody = $_PATCH['page-body'];
			$pageLayoutFilePath = $_PATCH['page-layout-file-path'];
			$pageHead = $_PATCH['page-head'];

			/** @var Page $editedPage */
			$abyss = new \Nox\ORM\Abyss();
			$editedPage = $abyss->fetchInstanceByModelPrimaryKey(
				model:Page::getModel(),
				keyValue: $pageID,
			);

			if (!$editedPage){
				return $response->getJsonError("No page with ID " . $pageID);
			}

			$editedPage->categoryID = $pageCategoryID;
			$editedPage->title = $pageTitle;
			$editedPage->pageLayoutFilePath = $pageLayoutFilePath;
			$editedPage->route = $pageRoute;
			$editedPage->body = $pageBody;
			$editedPage->head = $pageHead;
			$editedPage->save();

			return $response->getJsonSuccess();
		}
	}