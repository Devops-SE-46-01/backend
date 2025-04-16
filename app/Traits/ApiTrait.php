<?php

namespace App\Traits;

trait ApiTrait
{
    public function sendResponse($data, $code = 200)
	{
        return response()->json($data, $code);
	}
}