<?php
declare(strict_types=1);

namespace App\DTO\Response;

use App\Entity\Comment;

class CommentResponse
{
    public function getData(Comment $comment): array
    {
        return [
            'id' => $comment->getId(),
            'type' => 'Comment',
            'attributes' => [
                'title' => $comment->getTitle(),
                'text' => $comment->getText(),
                ]
            ];
    }
}
