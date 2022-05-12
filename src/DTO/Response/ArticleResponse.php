<?php
declare(strict_types=1);

namespace App\DTO\Response;

use App\Entity\Article;

class ArticleResponse
{
    public function getData(Article $article): array
    {
        return [
            'id' => $article->getId(),
            'type' => 'Article',
            'attributes' => [
                'title' => $article->getTitle(),
                'content' => $article->getContent(),
                'comments' => (new CommentCollectionResponse())->getData($article->getComments()),
                ]
            ];
    }
}
