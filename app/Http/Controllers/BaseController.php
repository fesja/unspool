<?php namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as Controller;

use Request;

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
            'data'    => [],
            'message' => 'Not found'
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

    protected function requestErrorResponse($data=array())
    {
        $response = [
            'code'    => 400,
            'status'  => 'error',
            'data'    => $data,
            'message' => 'Request not valid'
        ];
        return response()->json($response, $response['code']);
    }

    protected function getBody() {
        return json_decode(Request::getContent(), true);
    }
}
