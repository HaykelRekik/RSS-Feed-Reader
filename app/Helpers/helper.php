<?php

/**
 * Find the word with the most vowels in a string. 
 * If there are multiple words with the same number of vowels
 * return the word with the most letters.
 * 
 * @param string $string
 * @return string
 */
if (!function_exists('findWordWithMostVowels')) {
    function findWordWithMostVowels(string $string): ?string
    {
        $words = str_word_count($string, 1);
        $vowels = ['a', 'e', 'i', 'o', 'u', 'y'];
        $mostVowels = '';
        $maxVowels = 0;

        foreach ($words as $word) {
            $numVowels = 0;
            $wordLength = strlen($word);

            for ($i = 0; $i < $wordLength; $i++) {
                if (in_array(strtolower($word[$i]), $vowels)) {
                    $numVowels++;
                }
            }

            if ($numVowels > $maxVowels) {
                $mostVowels = $word;
                $maxVowels = $numVowels;
            } elseif (
                $maxVowels > 0 && $numVowels === $maxVowels && strlen($word) > strlen($mostVowels)
            ) {
                $mostVowels = $word;
            }
        }

        return $mostVowels;
    }
}
