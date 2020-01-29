<?php
/*
 * HttpClient
 *
 * (c) Ahmad Ganjtabesh <agtabesh@negare.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/

class ConsoleLogger {
	/**
	 * @method __construct
	 */
	public function __construct () {}

	/**
	 * @method log
	 * @param string $message
	 *
	 * @return $this
	 */
	public function log($message) {
		echo "$message% Completed!\n";
		return $this;
	}
}
