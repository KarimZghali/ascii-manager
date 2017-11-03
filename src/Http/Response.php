<?php



// montre le chemin afin que le programme trouve le classe (Vendor/package) :
namespace ASCII\Http;

class Response
{

	private $status, $reason, $header, $body;
	
	public function __construct()
	{
		$this->status = 200;
		$this->reason = "OK";
		$this->header = [];
		$this->body = "";
	}
	
	public function setStatus (int $status, string $reason)
	{
		$this->status = $status;
		$this->reason = $reason;
	}
	
	public function setHeader (array $header)
	{
		$this->header = $header;
	}
	
	public function addHeader (string $name, string $value)
	{
		$this->header[$name] = $value;
	}
	
	public function setBody (string $body)
	{
		$this->body = $body;
	}
	
	public function getBody() : string
	{
		return $this->body;
	}
	
	public function getHeader() : array
	{
		return $this->header;
	}
	
// 	public function getStatus() : array
// 	{
// 		return $this->$header;
// 	}
	
	public function getStatus() : string
	{
		return "HTTP/1.1 " . $this->status . ' ' . $this->reason; // -> http/1.1 200 ok
 	}
	

	
}
