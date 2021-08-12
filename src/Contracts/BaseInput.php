<?php

namespace Tohidplus\JsonResponse\Contracts;

use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;

abstract class BaseInput implements ArrayJsonSerializable
{
    /**
     * @var null
     */
    private $input;

    /**
     * BaseInput constructor.
     * @param null $input
     */
    public function __construct($input = null)
    {
        $this->input = $input;
    }

    /**
     * @return mixed
     */
    public function toArray()
    {
        if ($this->input instanceof Arrayable) {
            return $this->input->toArray();
        }
        if ($this->input instanceof JsonSerializable) {
            return $this->input->jsonSerialize();
        }
        if (is_object($this->input)) {
            return json_decode(json_encode($this->input), true);
        }
        return $this->input;
    }

    /**
     * @return mixed
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
