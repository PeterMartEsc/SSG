<?php

if (!defined('_PS_VERSION_')) {
	exit;
}

class Ps_Wellcome_Message extends Module
{
	public function __construct(){
 		$this->name = 'ps_wellcome_message';
		$this->version = '1.0.0';
		$this->author = 'Pedro Martin Escuela';
 		$this->tab = 'front_office_features';
 		$this->bootstrap = true;
 		$this->displayName = $this->trans('Wellcome Message', [], 'Modules.PsWellcomeMessage.Admin');
 		$this->description = $this->trans('Displays a personalized greeting message on the homepage.', [], 'Modules.PsWellcomeMessage.Admin');
 		parent::__construct();
 	}

	public function install(){
 		return parent::install() && $this->registerHook('displayHome');
 	}

	public function uninstall(){
 		return parent::uninstall();
	}

	public function hookDisplayHome($params){
 		$this->context->smarty->assign('wellcome_message', $this->getWellcomeMessage());
 		return $this->display(__FILE__, 'views/templates/hook/wellcome_message.tpl');
 	}

	private function getWellcomeMessage(){
 		$hour = (int)date('H');

		if ($hour < 12) {
 			return $this->trans('Good morning!', [], 'Modules.PsWellcomeMessage.Front');
 		} elseif ($hour < 18) {
 			return $this->trans('Good afternoon!', [], 'Modules.PsWellcomeMessage.Front');
 		} else {
 			return $this->trans('Good evening!', [], 'Modules.PsWellcomeMessage.Front');
 		}
 	}
}
