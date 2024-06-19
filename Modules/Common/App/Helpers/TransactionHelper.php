<?php

namespace Modules\Common\App\Helpers;

use Closure;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransactionHelper
{
    /**
     * Execute a callback within a database transaction.
     *
     * @param string $prefixMessage The message prefix for logging errors.
     * @param Closure $callback The callback function to execute within the transaction.
     * @param array $params Optional parameters to pass to the callback.
     * @return mixed The result of the callback function.
     */
    public static function beginTransaction(string $prefixMessage, Closure $callback, array $params = []): mixed
    {
        DB::beginTransaction();

        try {
            $result = $callback(...$params);

            DB::commit();

            return $result;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($prefixMessage . $e->getMessage());
            echo "Error: " . $e->getMessage() . "\n";
            throw $e;
        }
    }
}
