<?php

// Leia um arquivo CSV fornecido (data.csv)
if ($csv_resource = fopen('../data.csv', 'r')) {
    $csv_data = [
        'left' => [],
        'right' => []
    ];

    while($data = fgetcsv($csv_resource, 0, ";")) {
        $csv_data['left'][] = preg_replace('/\D/', '', $data[0]);
        $csv_data['right'][] = preg_replace('/\D/', '', $data[1]);
    }

    fclose($csv_resource);
}

echo '<pre>';
print_r($csv_data);
echo '</pre>';

// Crie uma função que receba um número e retorne "par" se for par e "ímpar" se for ímpar
function even_or_odd(int $number) {
    return $number % 2 === 0 ? 'par' : 'ímpar';
}

// Calcule a média das colunas numéricas e exiba o resultado
$left_columns_sum = array_reduce($csv_data['left'], function ($carry, $item) {
    return $carry + (int) $item;
}, 0);

$right_columns_sum = array_reduce($csv_data['right'], function ($carry, $item) {
    return $carry + (int) $item;
}, 0);

$left_column_average = (float) $left_columns_sum / (float) count($csv_data['left']);
$right_column_average = (float) $right_columns_sum / (float) count($csv_data['right']);

// Utilize a função para determinar se a média calculada é par ou ímpar e exiba o resultado
echo "A média dos números da coluna da esquerda é: $left_column_average, que é um número " . even_or_odd($left_column_average) . '<br>';
echo "A média dos números da coluna da direita é: $right_column_average, que é um número " . even_or_odd($right_column_average) . '<br>';