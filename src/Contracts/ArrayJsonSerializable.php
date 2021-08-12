<?php


namespace Tohidplus\JsonResponse\Contracts;

use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;

interface ArrayJsonSerializable extends JsonSerializable,Arrayable
{

}
