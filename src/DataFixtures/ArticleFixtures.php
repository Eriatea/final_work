<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends BaseFixtures
{
    private const ARTICLE_TITLES = [
        'Есть ли жизнь после девятой жизни?',
        'Когда в машинах поставят лоток?',
        'В погоне за красной точкой',
        'В чем смысл жизни сосисок',
    ];

    private const ARTICLE_IMAGES = [
        'bg-showcase-1.jpg',
        'bg-showcase-2.jpg',
        'bg-showcase-3.jpg',
    ];

    /**
     * @param ObjectManager $manager
     * @return void
     */
    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(Article::class, 10, function (Article $article) {
            $article
                ->setTitle($this->faker->randomElement(self::ARTICLE_TITLES))
                ->setDescription('Краткое описание статьи')
                ->setBody('Lorem ipsum **красная точка** dolor sit amet, consectetur adipiscing elit, sed
do eiusmod tempor incididunt [Сметанка](/) ut labore et dolore magna aliqua')
                ->setTheme('ключ')
                ->setKeywords('ключ')
                ->setKeyword('ключи')
                ->setImageFilename('bg-showcase-1.jpg')
                ->setImageFilename($this->faker->randomElement(self::ARTICLE_IMAGES));
        });
    }
}
