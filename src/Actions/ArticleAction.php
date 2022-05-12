<?php

declare(strict_types=1);

/**
 * This file is part of a Upply project.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Actions;

use App\Repository\ArticleRepository;
use App\Entity\Article;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleAction
{
    private ArticleRepository $articleRepository;

    function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function addArticle(array $requestParams) {

        //$resolvedParams = $this->resolve($requestParams);

        $article = new Article();
        $article->setTitle($requestParams['title']);
        $article->setContent($requestParams['content']);

        $this->articleRepository->add($article, true);

        return true;
    }

    public function getArticle(int $id) {
        return $this->articleRepository->find($id);
    }

    public function getAllArticles() {
        return $this->articleRepository->findAll();
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
