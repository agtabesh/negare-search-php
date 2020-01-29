<?php
/*
 * HttpClient
 *
 * (c) Ahmad Ganjtabesh <agtabesh@negare.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/

class Progress {
    private $progress = 0;
    private $progressMin = 0;
    private $progressMax = 100;
    private $verbose = false;

    /**
   * @method __construct
   * @param Logger $logger
   */
    public function __construct ($logger) {
        $this->logger = $logger;
    }

    /**
     * @method increment
     * @param integer $value
     *
     * @return $this
     */
    public function increment ($value) {
		$this->progress += $value;
        $this->logProgress();
        return $this;
    }

    /**
     * @method calculatePercentage
	 *
	 * @return integer
     */
    private function calculatePercentage () {
        $percentage = min(
            $this->progress - $this->progressMin,
            $this->progressMax - $this->progressMin
        ) / (
            $this->progressMax - $this->progressMin
        );
        return round($percentage * 1000) / 10;
    }

    /**
     * @method setProgressMax
     * @param integer $max
     *
     * @return $this
     */
    public function setProgressMin ($min) {
        $this->progressMin = $min;
        if ($this->progress < $min) $this->progress = $min;
        return $this;
    }

    /**
     * @method setProgressMax
     * @param integer $max
     *
     * @return $this
     */
    public function setProgressMax ($max) {
        $this->progressMax = $max;
        if ($this->progress > $max) $this->progress = $max;
        return $this;
    }

    /**
	 * @method enableVerbose
	 *
	 * @return $this
	 */
	public function enableVerbose() {
		$this->verbose = true;
		return $this;
    }

    /**
     * @method logProgress
     *
     * @return $this
     */
    public function logProgress () {
		if(!$this->verbose) return;
		$percentage = $this->calculatePercentage();
        $this->logger->log($percentage);
    }
}
