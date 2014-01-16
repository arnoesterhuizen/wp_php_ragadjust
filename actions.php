<?php
if(!class_exists('Ragadjust'))
{
	class Ragadjust
	{
		protected $_prepositions = array('aboard', 'about', 'above', 'across', 'after', 'against', 'along', 'amid', 'among', 'anti', 'around', 'as', 'at', 'before', 'behind', 'below', 'beneath', 'beside', 'besides', 'between', 'beyond', 'but', 'by', 'concerning', 'considering', 'despite', 'down', 'during', 'except', 'excepting', 'excluding', 'following', 'for', 'from', 'in', 'inside', 'into', 'like', 'minus', 'near', 'of', 'off', 'on', 'onto', 'opposite', 'outside', 'over', 'past', 'per', 'plus', 'regarding', 'round', 'save', 'since', 'than', 'through', 'to', 'toward', 'towards', 'under', 'underneath', 'unlike', 'until', 'up', 'upon', 'versus', 'via', 'with', 'within', 'without');
		protected $_shortwords   = array('[a-z]{1,3}');
		protected $_dashes       = array('[-–—]|&(?:[mn]dash|#(?:x201[2-4]|821[1-2]));');
		protected $_emphasis     = array('');

		/**
		 * Construct the plugin object
		 */
		public function __construct()
		{
			// register actions
			add_action('init', array(&$this, 'init'));
		} // END public function __construct

		/**
		 * hook into WP's admin_init action hook
		 */
		public function init()
		{
			add_filter( 'the_content', array(&$this, 'ragadjust' ) , 10, 3 );
		} // END public static function init

		/**
		 * Adjust the rag
		 */
		public function ragadjust($content)
		{
			$replacements = array();

			//protect prepositons
			if (true) { //if I need to check prepositions
				$replacements = array_merge($replacements, $this->prepare_patterns($this->_prepositions));
			}
			if (true) { //if I need to check short words
				$replacements = array_merge($replacements, $this->prepare_patterns($this->_shortwords));
			}
			if (true) { //if I need to check dashes
				$replacements = array_merge($replacements, $this->prepare_patterns($this->_dashes, false));
			}
			$content = preg_replace($replacements, '$1&#160;', $content);

			if (false) { //if I need to adjust emphasised words of 2-3 words
				$content = preg_replace($replacements, preg_replace('/\s/', '~', $content), $content);
			}
			return $content;
		} // END public static function init

		/**
		 * Adjust the rag
		 */
		public function prepare_patterns($replacements = array(), $wholewords = true)
		{
			foreach ($replacements as $i => $replacement) {
				if (true === $wholewords) {
					$replacements[$i] = '/(?:\b)(' . $replacement . ')\s+/i';
				} else {
					$replacements[$i] = '/(' . $replacement . ')\s+/i';
				}
			}
			return $replacements;
		} // END public function prepare_patterns
	} // END class WP_PHP_Ragadjust
} // END if(!class_exists('WP_PHP_Ragadjust'))
