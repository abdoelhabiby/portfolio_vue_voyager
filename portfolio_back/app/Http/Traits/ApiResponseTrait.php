<?php

namespace App\Http\Traits;



trait ApiResponseTrait
{




    public function apiResponse($value = [], $status, $message = null)
    {
        $data = [
            "status" => $status,
            "message" => $message,
            "data" => $value
        ];

        return response()->json($data);
    }

    protected function returnErrorException($e)
    {
        return $this->apiResponse([], false, $e->getMessage());
    }



    public function notFound()
    {
        return $this->apiResponse([], false, 'not found');
    }
}
