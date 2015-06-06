<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as Controller;

class BaseController extends Controller
{
    protected function createdResponse($data=array())
    {
        $response = [
            'code'   => 201,
            'status' => 'succcess',
            'data'   => $data
        ];
        return response()->json($response, $response['code']);
    }

    protected function showResponse($data=array())
    {
        $response = [
            'code'   => 200,
            'status' => 'succcess',
            'data'   => $data
        ];
        return response()->json($response, $response['code']);
    }

    protected function listResponse($data=array())
    {
        $response = [
            'code'   => 200,
            'status' => 'succcess',
            'data'   => $data
        ];
        return response()->json($response, $response['code']);
    }

    protected function notFoundResponse()
    {
        $response = [
            'code'    => 404,
            'status'  => 'error',
            'data'    => 'Resource Not Found',
            'message' => 'Not Found'
        ];
        return response()->json($response, $response['code']);
    }

    protected function deletedResponse()
    {
        $response = [
            'code'    => 204,
            'status'  => 'success',
            'data'    => [],
            'message' => 'Resource deleted'
        ];
        return response()->json($response, $response['code']);
    }

    protected function clientErrorResponse($data=array())
    {
        $response = [
            'code'    => 422,
            'status'  => 'error',
            'data'    => $data,
            'message' => 'Unprocessable entity'
        ];
        return response()->json($response, $response['code']);
    }

    protected function getBody($request) {
        return json_decode($request->getContent(), true);
    }
}
