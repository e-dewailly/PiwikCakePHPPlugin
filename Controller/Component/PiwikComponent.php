<?php
App::uses('Component', 'Controller');

class PiwikComponent extends Component {

	public $settings = [
		'URL' => '',
		'idSite' => 0,
		'configCookies' => array(
			'disabled' => false,
			'path' => '/',
			'domain' => '',
		),
		'autotrack' => true,
	];

	public function __construct(ComponentCollection $collection, $settings = []) {
		$this->settings = array_merge($this->settings, $settings);

		App::import('Vendor', 'Piwik.PiwikTracker');
		if (!empty($this->PiwikTracker)) return;
		$this->PiwikTracker = new PiwikTracker($this->settings['idSite'], $this->settings['URL']);
		if (!$this->settings['configCookies']['disabled']) $this->PiwikTracker->enableCookies($this->settings['configCookies']['domain'], $this->settings['configCookies']['path']);
	}

	public function __call($name, $arguments) {
		if (method_exists($this->PiwikTracker, $name)) {
			return call_user_func_array(array($this->PiwikTracker, $name), $arguments);
		}
		trigger_error("Méthode {$name} inconnue !");
	}

	public function initialize(Controller $controller) {
		$this->Controller = $controller;
		$params = $controller->request->params;
		$params['controller'] = strtoupper($params['controller']);
		$params['action'] = ucfirst($params['action']);
		$this->title = "{$params['controller']} > {$params['action']}".($params['named']?' -> '.http_build_query($params['named'], ' ', ' > '):null);
	}

	public function startup(Controller $controller) {
		$this->doTrackPageView($this->title);
	}


	public function getVisitCount() { return $this->PiwikTracker->visitCount; }

}