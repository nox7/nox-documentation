<?php
	namespace NoxDocumentation\ParsedownWrapper;

	use Erusev\Parsedown\Parsedown;

	class ParsedownWrapper{
		private static Parsedown $parsedown;

		public static function get(): Parsedown{
			if (!isset(self::$parsedown)){
				self::$parsedown = new Parsedown();
			}

			return self::$parsedown;
		}
	}