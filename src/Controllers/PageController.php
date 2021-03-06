<?php

namespace Controllers;

use Models\Pages;
use Flight;

class PageController extends FrontController
{
	public function indexAction(){
		try {
			$this->pageData['pages'] = Pages::getAll();
			$this->pageData['routePages'] = $this->routesSettings['pages'];
			unset($this->pageData['menu']['Install']);
		} catch (\Exception $e){}

		$this->render('pageLists.twig');
	}

	public function homeAction(){
		try {
			$this->pageData['homepage'] = Pages::getHomePage();
			$this->pageData['routePages'] = $this->routesSettings['pages'];
			unset($this->pageData['menu']['Install']);
		} catch (\Exception $e){}

		$this->render('home.twig');
	}

	public function detailAction($code){
		try {
			$this->pageData['page'] = Pages::where('active', true)->where('code', $code)->firstOrFail();
			$this->pageData['routePages'] = $this->routesSettings['pages'];
			unset($this->pageData['menu']['Install']);
			$this->render('pageDetail.twig');
		} catch (\Exception $e){
			Flight::notFound();
		}
	}

	public static function phpinfoAction(){
		phpinfo();
	}
}