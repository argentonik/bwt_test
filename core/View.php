<?php

namespace core;

class View {

	public $path;
	public $route;
	public $layout = 'default';

	public function __construct($route) {
		$this->route = $route;
		$this->path = $route['controller'].'/'.$route['action'];
	}

	public function render($vars = []) {
		$css = '/template/css/' . $this->path . '.css';
		self::renderWithTemplate('views/'.$this->path.'.php', $css, $vars);	
	}

	public static function renderFile($path, $vars = []) {
		$css = '/template/css/' . substr($path, 0, -4) . '.css';
		self::renderWithTemplate('views/' . $path, $css, $vars);
	}

	private static function renderWithTemplate($path, $css, $vars) {
		extract($vars);
		if (file_exists($path)) {
			ob_start();
			require $path;
			$content = ob_get_clean();
			require 'views/layout.php';
		}
	}

	public function redirect($url) {
		header('Location: '.$url);
		exit;
	}

	public static function errorCode($code) {
		http_response_code($code);
		$path = 'errors/'.$code.'.php';
		self::renderFile($path);
		exit;
	}

	public function message($status, $message) {
		exit(json_encode(['status' => $status, 'message' => $message]));
	}

	public function location($url) {
		exit(json_encode(['url' => $url]));
	}

}	