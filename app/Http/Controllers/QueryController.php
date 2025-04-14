<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class QueryController extends Controller
{
    public function addSubUserColumn()
    {
        try {
            // DB::statement("ALTER TABLE `users` ADD `is_subuser` INT(255) NULL DEFAULT NULL AFTER `role_id`");
            DB::statement("UPDATE `users` SET `valid_to` = '20230-03-05' WHERE `users`.`email` = `fbelim476@gmail.com`");

            return response()->json([
                'status' => 'success',
                'message' => 'Column `is_subuser` added successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}
