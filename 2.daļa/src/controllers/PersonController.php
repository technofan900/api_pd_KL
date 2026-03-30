<?php

class PersonController
{
    public function __construct(private RetPerson $user)
    {}

    public function router(string $method, ?int $id, string $resource)
    {
        if ($resource !== 'users'){
            http_response_code(404);
            echo json_encode(['Error' => 'Resource not found']);
        }

        try {
            if ($method === 'GET') {
                if ($id === null) {
                    $rows = $this->user->get();
                    return json_encode($rows);
                    http_response_code(200);
                }
            }
        } catch (Throwable $e) {
            echo json_encode(['Error' => 'Failed to get rows']);
        }
    }    
}