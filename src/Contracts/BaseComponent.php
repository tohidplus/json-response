<?php


namespace Tohidplus\JsonResponse\Contracts;

abstract class BaseComponent implements ArrayJsonSerializable
{
    /**
     * @var BaseInput
     */
    private BaseInput $data;
    /**
     * @var BaseInput
     */
    private BaseInput $meta;

    /**
     * BaseComponent constructor.
     * @param BaseInput $data
     * @param BaseInput $meta
     */
    public function __construct(BaseInput $data, BaseInput $meta){

        $this->data = $data;
        $this->meta = $meta;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $data = $this->data->toArray();
        $meta = $this->meta->toArray();
        if (!$meta && !$data) {
            return [];
        }
        return [
            'data' => $data,
            'meta' => $meta,
        ];
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
