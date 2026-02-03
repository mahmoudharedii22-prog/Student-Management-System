<?php

namespace App\Traits;

trait ApiResponse
{
    public function success($message, $statuscode)
    {
        return response()->json(['success' => $message, 'code' => $statuscode], $statuscode);
    }

    public function error($message, $statuscode)
    {
        return response()->json(['error' => $message, 'code' => $statuscode], $statuscode);
    }

    public function successWithData($message, $statuscode, $data)
    {
        return response()->json(['success' => $message, 'code' => $statuscode, 'data' => $data], $statuscode);
    }

    public function successWithPagination($message, $statuscode, $data, $meta)
    {
        return response()->json(['success' => $message, 'code' => $statuscode, 'data' => $data, 'meta' => [
            'current_page' => $meta->currentPage(),
            'per_page' => $meta->perPage(),
            'last_page' => $meta->lastPage(),
            'total' => $meta->total(),
            'next_page_url' => $meta->nextPageUrl(),
            'prev_page_url' => $meta->previousPageUrl(),
            'path' => $meta->path(),

        ]], $statuscode);
    }
}
