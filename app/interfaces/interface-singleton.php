<?php

namespace WP_Plugin_Boilerplate\Interfaces;

interface Singleton {
	public function init();

	public static function instance();
}
