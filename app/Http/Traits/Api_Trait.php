<?php
namespace App\Http\Traits;

trait Api_Trait
{

    public function getCurrentLang()
    {
        return app()->getLocale();
    }

    public function returnError($message,$status = 400)
    {
        return response()->json([
            'data' => null,
            'message' => $message,
            'status' => $status,
        ],200);
    }

    public function returnErrorValidation($message,$status = 403)
    {
        return response()->json([
            'data' => null,
            'message' => $message,
            'status' => $status,
        ],200);
    }

    public function returnErrorNotFound($message,$status = 401)
    {
        return response()->json([
            'data' => null,
            'message' => $message,
            'status' => $status,
        ],200);
    }



    public function returnData( $data, $message,$status=200)
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'status' => $status,
        ],200);
    }



}
