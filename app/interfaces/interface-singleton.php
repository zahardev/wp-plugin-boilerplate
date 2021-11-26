<?php

namespace __WP_Plugin_Boilerplate__\Interfaces;

interface Singleton {
	public function init();

	public static function instance();
}
