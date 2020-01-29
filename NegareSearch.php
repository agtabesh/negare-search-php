<?php
/*
 * HttpClient
 *
 * (c) Ahmad Ganjtabesh <agtabesh@negare.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/

require_once('libs/ConsoleLogger.php');
require_once('libs/Progress.php');
require_once('libs/HttpClient.php');

class NegareSearch {
	/**
	 * store negare search api url to communicate with
	 */
	private $apiUrl;

	/**
	 * store unique api key to communicate with negare servers
	 */
	private $apiKey;

	/**
	 * to improve performance, documents split into chunks so instead of sending
	 * all documents at once, we send one chunk at each request
	 */
	private $chunkSize = 100;

	/**
	 * @method __construct
	 * @param string $apiKey
	 */
	public function __construct($apiUrl, $apiKey) {
		$this->apiUrl = $apiUrl;
		$this->apiKey = $apiKey;
		$this->progress = new Progress(new ConsoleLogger());
		$this->httpClient = new HttpClient($this->apiUrl, $this->apiKey);
	}

	/**
	 * @method setApiUrl
	 * @param string $apiUrl
	 *
	 * @return $this
	 */
	public function setApiUrl ($apiUrl) {
		$this->apiUrl = $apiUrl;
		return $this;
	}

	/**
	 * @method enableVerbose
	 *
	 * @return void
	 */
	public function enableVerbose() {
    	return $this->progress->enableVerbose();
	}

	/**
	 * @method createBulk
	 * @param array|object $data
	 *
	 * @return $this
	 */
	public function store ($data) {
		$method = is_array($data) ? 'storeBulk' : 'storeSingle';
		$this->$method($data);
		return $this;
	}

	/**
	 * @method storeBulk
	 * @param array $documents
	 *
	 * @return void
	 */
	private function storeBulk ($documents) {
    	$this->progress->setProgressMin = 0;
		$this->progress->setProgressMax(count($documents));
		$chunks = array_chunk($documents, $this->chunkSize);
		foreach ($chunks as $chunk) {
      		$this->httpClient->post('documents', $chunk);
      		$this->progress->increment(count($chunk));
		}
	}

	/**
	 * @method storeSingle
	 * @param object $document
	 *
	 * @return void
	 */
	private function storeSingle ($document) {
		$this->httpClient->post('documents', $document);
	}

	/**
	 * @method update
	 * @param integer $documentId
	 * @param object $document
	 *
	 * @return void
	 */
	public function update ($documentId, $document) {
		$this->httpClient->put("documents/{$documentId}", $document);
	}

	/**
	 * @method delete
	 * @param integer $documentId
	 * @param object $document
	 *
	 * @return void
	 */
	public function delete ($documentId) {
		$this->httpClient->delete("documents/{$documentId}");
	}

	/**
	 * @method search
	 * @param object $params
	 *
	 * @return object
	 */
	public function search ($params) {
		$result = $this->httpClient->get("search", $params);
		return json_decode($result);
	}

	/**
	 * @method autoComplete
	 * @param object $params
	 *
	 * @return object
	 */
	public function autoComplete ($params) {
		$result = $this->httpClient->get("auto-complete", $params);
		return json_decode($result);
	}
}
