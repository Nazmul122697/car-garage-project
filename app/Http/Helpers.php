<?php

/**
 * unique_digit(User::class, "db_column_name", 18);
 */

//  if (!function_exists("unique_digit")) {
//     function unique_digit($model, $column, $digits = 16)
//     {
//         while(true) {
//             $result = rand(pow(10, $digits-1), pow(10, $digits)-1);
//             $model = $model::query()->where($column, $result)->first();
//             if(!isset($model)) return $result;
//         }
//     }
// }
