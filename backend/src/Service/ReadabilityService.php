<?php

namespace App\Service;

class ReadabilityService
{
    /**
     * Returns: 'Easy' | 'Medium' | 'Advanced' | 'Unknown'
     */
    public function calculateLevel(string $text): string
    {
        $text = trim($text);
        if ($text === '') return 'Unknown';

        $words     = $this->countWords($text);
        $sentences = $this->countSentences($text);
        $syllables = $this->countSyllables($text);

        if ($words === 0 || $sentences === 0) return 'Unknown';

        $score = 0.39 * ($words / $sentences) + 11.8 * ($syllables / $words) - 15.59;

        if ($score < 6)  return 'Easy';
        if ($score < 10) return 'Medium';
        return 'Advanced';
    }

    private function countWords(string $text): int
    {
        $words = preg_split('/\s+/', trim($text), -1, PREG_SPLIT_NO_EMPTY);
        return $words ? count($words) : 0;
    }

    private function countSentences(string $text): int
    {
        $parts = preg_split('/[.!?]+\s*/', $text, -1, PREG_SPLIT_NO_EMPTY);
        return $parts ? count($parts) : 1;
    }

    private function countSyllables(string $text): int
    {
        $vowels = ['a','e','i','o','u','y','à','â','è','é','ê','ë','î','ï','ô','ù','û','ü','ÿ'];
        $chars  = preg_split('//u', mb_strtolower($text), -1, PREG_SPLIT_NO_EMPTY);
        $count  = 0;
        $prev   = false;
        foreach ($chars as $ch) {
            $isVowel = in_array($ch, $vowels, true);
            if ($isVowel && !$prev) $count++;
            $prev = $isVowel;
        }
        return $count;
    }
}
