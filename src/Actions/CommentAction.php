<?php

declare(strict_types=1);

/**
 * This file is part of a Upply project.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Actions;

use App\DTO\Response\ArticleResponse;
use App\Entity\User;
use App\Repository\ArticleRepository;
use App\Repository\CommentRepository;
use App\Entity\Comment;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentAction
{
    private CommentRepository $commentRepository;
    private ArticleRepository $articleRepository;

    function __construct(CommentRepository $commentRepository, ArticleRepository $articleRepository)
    {
        $this->commentRepository = $commentRepository;
        $this->articleRepository = $articleRepository;
    }

    public function addComment(array $requestParams) {

        //$resolvedParams = $this->resolve($requestParams);


        $article = $this->articleRepository->find($requestParams['article']);
        $requestParams['article'] = $article;

        $parent = null;
        if ($requestParams['parent'] ?? false) {
            $parent = $this->commentRepository->find($requestParams['parent']);
        }

        $article = $requestParams['article'];
        if (null !== $parent) {
            $article = null;
        }

        $comment = new Comment();
        $comment->setTitle($requestParams['title'] ?? null);
        $comment->setText($requestParams['text']);
        $comment->setArticle($article);
        $comment->setParent($parent);

        $this->commentRepository->add($comment, true);

        return true;
    }

    public function getArticle(int $id) {
        return $this->articleRepository->find($id);
    }
}
