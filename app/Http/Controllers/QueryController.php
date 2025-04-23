<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class QueryController extends Controller
{
    public function addSubUserColumn()
    {
        // try {
        //     // 1. ALTER TABLE query for `contacts`
        //     DB::statement("ALTER TABLE `contacts` CHANGE `contact_email` `contact_email` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL");

        //     // 2. UPDATE query for `users`
        //     // DB::statement("UPDATE `users` SET `valid_to` = '2023-03-05' WHERE `users`.`email` = 'fbelim476@gmail.com'");

        //     return response()->json([
        //         'status' => 'success',
        //         'message' => 'Queries executed successfully!'
        //     ]);
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => $e->getMessage()
        //     ]);
        // }
        // try {
        //     DB::statement("
        //         CREATE TABLE `activity_log` (
        //           `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        //           `log_name` VARCHAR(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        //           `description` TEXT COLLATE utf8mb4_unicode_ci NOT NULL,
        //           `subject_type` VARCHAR(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        //           `event` VARCHAR(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        //           `subject_id` BIGINT(20) UNSIGNED DEFAULT NULL,
        //           `causer_type` VARCHAR(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        //           `causer_id` BIGINT(20) UNSIGNED DEFAULT NULL,
        //           `properties` LONGTEXT COLLATE utf8mb4_bin DEFAULT NULL,
        //           `batch_uuid` CHAR(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        //           `created_at` TIMESTAMP NULL DEFAULT NULL,
        //           `updated_at` TIMESTAMP NULL DEFAULT NULL,
        //           PRIMARY KEY (`id`),
        //           KEY `activity_log_log_name_index` (`log_name`),
        //           KEY `subject` (`subject_type`, `subject_id`),
        //           KEY `causer` (`causer_type`, `causer_id`)
        //         ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        //     ");
        
        //     return response()->json([
        //         'status' => 'success',
        //         'message' => 'activity_log table created successfully!'
        //     ]);
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => $e->getMessage()
        //     ]);
        // }
        return response()->json([
            'status' => 'success',
            'message' => 'done done done'
        ]);
        
    }

}
