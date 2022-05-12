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

        $parent = $this->commentRepository->find($requestParams['parent']);

        $comment = new Comment();
        $comment->setTitle($requestParams['title']);
        $comment->setText($requestParams['text']);
        $comment->setArticle($requestParams['article']);
        $comment->setParent($parent);

        $this->commentRepository->add($comment, true);

        return true;
    }

    public function getArticle(int $id) {
        return $this->articleRepository->find($id);
    }

/*
    public function getKnigth(int $id) {
        return $this->articleRepository->find($id);
    }

    public function getArticles() {
        return $this->articleRepository->findAll();
    }

    private function resolve(array $data): array
    {
        return (new OptionsResolver())
            ->setRequired(['power', 'strength', 'weaponPower'])
            ->setNormalizer('power', function (Options $options, $data) {
                return intval($data);
            })
            ->setNormalizer('strength', function (Options $options, $data) {
                return intval($data);
            })
            ->setNormalizer('weaponPower', function (Options $options, $data) {
                return intval($data);
            })
            ->resolve($data)
            ;
    }
*/
}
