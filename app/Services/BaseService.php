<?php

namespace App\Services;

use App\Serializer\CustomSerializer;
use League\Fractal\Manager;
use Spatie\Fractalistic\Fractal;

class BaseService
{
	/**
	 * @var array
	 */
	protected $parseIncludes = [];

	/**
	 * @var string
	 */
	protected $statusCode = 200;

	/**
	 * @var array
	 */
	protected $data = [];

	/**
	 * @var array
	 */
	protected $message = [];

	/**
	 * @param string $value
	 */
	public function setParseInclude($value)
	{
		return	$this->parseIncludes = $value;
	}

	/**
	 * @param int $statusCode
	 * @return self
	 */
	public function setStatus($statusCode)
	{
		$this->statusCode = $statusCode;
        return $this;
	}

	/**
	 * @param array $data
	 * @return self
	 */
	public function setData($data) 
	{
        $this->data = $data;
        return $this;
    }

    /**
     * @param string $message
     */
    public function setMessage($message) 
    {
        $this->message = ['message' => $message];
        return $this;
    }

    /**
	 *
	 */
	public function collection($collection, $transform, $resource)
	{
		return $this->setData((new Fractal(new Manager()))
			->serializeWith(new CustomSerializer())
			->parseIncludes($this->parseIncludes)
			->collection($collection, $transform, $resource)
			->toArray());
	}

	/**
	 *
	 */
	public function item($collection, $transform, $resource)
	{
		return $this->setData((new Fractal(new Manager()))
			->serializeWith(new CustomSerializer())
			->parseIncludes($this->parseIncludes)
			->item($collection, $transform, $resource)
			->toArray());
	}

	/**
	 * @return array
	 */
	protected function body()
	{
		return ['status_code' => $this->statusCode] + $this->message + $this->data;
	}

	/**
	 * @param array $headers
	 */
	protected function success(array $headers = [])
	{
		return $this->respond(['success' => true], $headers);
	}

	/**
	 * @param string $errorMessage
	 * @param int $errorLine
	 * @param int $errorCode
	 * @param array $headers
	 */
	protected function error($errorMessage, $errorLine, $errorCode, array $headers = [])
	{
		return $this->respond([
			'success' => false, 
			'error' => [
				'code' => $errorCode,
				'message' => $errorMessage,
				'line' => $errorLine,
			],
		], $headers);
	}

	/**
     * @param array $array
     * @param array $headers
     * @return mixed
     */
    protected function respond(array $array = [], array $headers = [])
    {
        return response()->json($array + $this->body(), $this->statusCode, $headers);
    }
}
