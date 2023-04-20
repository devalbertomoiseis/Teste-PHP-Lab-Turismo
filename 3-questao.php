<?php

define("VOWELS", ['a', 'e', 'i', 'o', 'u']);

function isValidMagicSequence(string $sequence): bool
{
    return !in_array(
        false,
        array_map(
            fn (string $vowel) => str_contains($sequence, $vowel),
            VOWELS
        )
    );
}

function magicSequence(string $string): string
{
    [$magicSequence] = array_reduce(
        str_split($string),
        function (array $result, string $letter): array {
            [$sequence, $currentVowel] = $result;

            $isCurrentVowel = $letter === VOWELS[min($currentVowel, 4)];
            $isNextVowel = $letter === VOWELS[min($currentVowel + 1, 4)];

            return match (true) {
                $isCurrentVowel => [$sequence . $letter, $currentVowel],
                $isNextVowel => [$sequence . $letter, $currentVowel + 1],
                default => [$sequence, $currentVowel]
            };
        },
        ['', 0]
    );

    return $magicSequence;
}

function challenge(string $sequence): int
{
    $magicSequence = magicSequence($sequence);
    return isValidMagicSequence($magicSequence)
        ? strlen($magicSequence)
        : 0;
}

echo challenge("aeiaaioooau") . PHP_EOL;
echo challenge("aeiaaioooaauuaeiou") . PHP_EOL;
echo challenge("aeiaaioooaa") . PHP_EOL;