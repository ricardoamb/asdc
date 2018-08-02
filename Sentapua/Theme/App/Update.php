<?php
/**
 * @package SentapuaTheme
 */

namespace SentapuaTheme\Theme\App;

use SentapuaTheme\Theme\ThemeBaseController;

class Update extends ThemeBaseController
{

	public function register()
	{

		require $this->theme_path . 'Sentapua/Theme/App/updater/plugin-update-checker.php';

		$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(

			'https://github.com/ricardoamb/asdc/',
			$this->theme_path . 'functions.php',
			'asdc'

		);

		//Optional: If you're using a private repository, specify the access token like this:
		$myUpdateChecker->setAuthentication('02f00b1f01ff56f41637692e8cb17550b75801a3');

		//Optional: Set the branch that contains the stable release.
		$myUpdateChecker->setBranch('stable');

	}

	private function theme_updater()
	{


	}

}