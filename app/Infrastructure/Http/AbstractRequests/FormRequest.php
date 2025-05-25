<?php

namespace App\Infrastructure\Http\AbstractRequests;

interface FormRequest
{
    /**
     * Define Rules
     *
     * @return array
     */
    public function rules();

    /**
     * Define validated data
     *
     * @return array
     */
    public function validated();
}
