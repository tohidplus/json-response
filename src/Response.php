<?php

namespace Tohidplus\JsonResponse;

use Tohidplus\JsonResponse\Contracts\ArrayJsonSerializable;
use Tohidplus\JsonResponse\Contracts\BaseComponent;

class Response implements ArrayJsonSerializable
{
    /**
     * @var BaseComponent
     */
    private BaseComponent $result;
    /**
     * @var BaseComponent
     */
    private BaseComponent $error;
    /**
     * @var string
     */
    private string $status;
    /**
     * @var int
     */
    private int $statusCode;

    /**
     * Response constructor.
     * @param BaseComponent $result
     * @param BaseComponent $error
     * @param string $status
     * @param int $statusCode
     */
    public function __construct(BaseComponent $result, BaseComponent $error, string $status, int $statusCode)
    {
        $this->result = $result;
        $this->error = $error;
        $this->status = $status;
        $this->statusCode = $statusCode;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $response = [
            'status' => $this->status,
            'statusCode' => $this->statusCode
        ];
        if ($result = $this->result->toArray()) {
            $response['result'] = $result;
        }
        if ($error = $this->error->toArray()) {
            $response['error'] = $error;
        }
        return $response;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
