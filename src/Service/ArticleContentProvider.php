<?php

namespace App\Service;

class ArticleContentProvider
{
    private const WORDS = [
        'PHP',
        'Laravel',
        'Symfony',
        'Composer',
        'PHPUnit',
        'HTML',
        'CSS',
        'JavaScript',
        'Vue',
        'React',
        'Angular',
        'Bootstrap',
        'Tailwind',
        'MySQL',
        'PostgreSQL',
        'MongoDB',
        'Redis',
        'Docker',
        'Kubernetes',
        'AWS',
        'Azure',
        'Google Cloud'
    ];

    /**
     * @return string
     */
    public function start(): string
    {
        $paragraphs = rand(2, 10);
        $probability = rand(0, 100);

        if ($probability >= 70) {
            $word = self::WORDS[array_rand(self::WORDS, true)];
            $wordsCount = rand(1, 5);
            $content = $this->get($paragraphs, $word, $wordsCount);
        } else $content = $this->get($paragraphs);

        return $content;
    }

    /**
     * @param int $paragraphs
     * @param string|null $word
     * @param int $wordsCount
     * @return string
     */
    public function get(int $paragraphs, string $word = null, int $wordsCount = 0): string
    {
        $content = '';

        for ($i = 0; $i < $paragraphs; $i++) {
            if ($wordsCount === 0) $wordsCount = rand(200, 300);
            if ($word === null) $word = self::WORDS[array_rand(self::WORDS, true)];
            $content .= '<p>' . str_repeat("$word ", $wordsCount) . '</p>';
        }

        return $content;
    }
}