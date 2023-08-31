<?php

namespace Illuminate\Http;

use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
{
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    public $collage;
}
