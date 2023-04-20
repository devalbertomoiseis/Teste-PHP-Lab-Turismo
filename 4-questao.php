?php

function map(callable $fn, array $array): array
{
    $copy = [];

    foreach ($array as $index => $item) {
        $copy[] = $fn($item, $index, $array);
    }

    return $copy;
}

function between(int $start, int $end, int $value): bool
{
    return $value >= $start && $value <= $end;
}

function sliceSum(array $array, int $start, int $end, int $increment): array
{
    $startIndex = max(0, $start - 1);
    $endIndex = max(0, $end - 1);

    $incrementValue = fn (int $index) => between($startIndex, $endIndex, $index) ? $increment : 0;

    return map(
        fn (int $item, int $index) => $item + $incrementValue($index),
        $array
    );
}

function challenge(array $array, array $entries): int
{
    return max(
        array_reduce(
            $entries,
            fn ($result, $values) => sliceSum($result, ...$values),
            $array
        )
    );
}

echo challenge(
    [0, 0, 0, 0, 0],
    [
        [1, 2, 10],
        [2, 4, 5],
        [3, 5, 12]
    ]
) . PHP_EOL;

echo challenge(
    [0, 0, 0, 0, 0],
    [
        [1, 2, 100],
        [2, 5, 100],
        [3, 4, 100]
    ]
) . PHP_EOL;