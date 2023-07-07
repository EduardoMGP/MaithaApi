<?php

namespace App\Http\Resources;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

/**
 * @property bool $success
 * @property int $code
 * @property string|null $message
 * @property JsonResource|null $data
 */
class ApiResource extends JsonResource
{

    public static $wrap = null;
    private bool $success;
    private int $code;
    private string|null $message;
    private $data;


    public function __construct($data, $message = null, $success = true, $code = Response::HTTP_OK)
    {
        parent::__construct($data);
        $this->success = $success;
        $this->code = $code;
        $this->message = $message;
        $this->data = $data;
        $this->response()->header('Content-Type', 'application/json');
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'success' => $this->success,
            'message' => $this->when($this->message != null, $this->message),
            'data' => $this->when($this->data != null, $this->data)
        ];
    }

    public function withResponse(Request $request, JsonResponse $response): JsonResponse
    {
        $response->setStatusCode($this->code);
        return $response;
    }
}
