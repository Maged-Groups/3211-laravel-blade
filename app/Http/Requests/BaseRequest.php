<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Traits\FunctionsTrait;

class BaseRequest extends FormRequest
{
    use FunctionsTrait;
}