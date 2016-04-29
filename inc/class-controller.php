<?php

namespace runcommand;

abstract class Controller {

	private static $instances = array();

	public static function get_instance() {
		$class = get_called_class();
		if ( ! isset( self::$instances[ $class ] ) ) {
			self::$instances[ $class ] = new $class;
			self::$instances[ $class ]->setup_actions();
			self::$instances[ $class ]->setup_filters();
		}
		return self::$instances[ $class ];
	}

	protected function setup_actions() {
		/** Override in a subclass if needed **/
	}

	protected function setup_filters() {
		/** Override in a subclass if needed **/
	}

}
