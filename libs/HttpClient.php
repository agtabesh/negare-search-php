<?php
/*
 * HttpClient
 *
 * (c) Ahmad Ganjtabesh <agtabesh@negare.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/

class HttpClient
{
	/**
	 * @method __construct
	 * @param string $apiUrl
	 * @param string $apiKey
	 */
	public function __construct ($apiUrl, $apiKey)
	{
		$this->apiUrl = $apiUrl;
		$this->apiKey = $apiKey;
	}

	/**
	 * @method get
	 * @param string $endpoint
	 * @param array $data
	 *
	 * @return object
	 */
	public function get ($endpoint, $data)
	{
		return $this->sendHttpRequest('GET', $endpoint, $data);
	}

	/**
	 * @method post
	 * @param string $endpoint
	 * @param array $data
	 *
	 * @return object
	 */
	public function post ($endpoint, $data)
	{
		return $this->sendHttpRequest('POST', $endpoint, $data);
	}

	/**
	 * @method put
	 * @param string $endpoint
	 * @param array $data
	 *
	 * @return object
	 */
	public function put ($endpoint, $data)
	{
		return $this->sendHttpRequest('PUT', $endpoint, $data);
	}

	/**
	 * @method delete
	 * @param string $endpoint
	 * @param array $data
	 *
	 * @return object
	 */
	public function delete ($endpoint)
	{
		return $this->sendHttpRequest('DELETE', $endpoint);
	}

	/**
	 * @method sendHttpRequest
	 * @param string $method
	 * @param string $endpoint
	 * @param array $data
	 *
	 * @return object
	 */
	private function sendHttpRequest ($method, $endpoint, $data = [])
	{
		$url = "{$this->apiUrl}{$endpoint}";
		$data = json_encode($data, JSON_UNESCAPED_UNICODE);
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Content-Type: application/json',
			"API-KEY: {$this->apiKey}"
		]);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$curl_result = curl_exec($ch);
		curl_close($ch);
		return $curl_result;
	}
}
