<?php
declare(strict_types=1);

namespace App\DTO\Response;

use App\DTO\Response\CommentResponse;

class CommentCollectionResponse
{
    public function getData(iterable $comments): array
    {
        $response = [];

        foreach ($comments as $comment) {
            $response[] = (new CommentResponse())->getData($comment);
        }

        return $response;
    }
}
