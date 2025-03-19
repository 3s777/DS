<?php

namespace Support;

use Closure;
use Illuminate\Support\Facades\DB;
use Support\Exceptions\TransactionException;
use Throwable;

class Transaction
{
    public static function run(
        Closure $callback,
        Closure $onError = null,
        Closure $onSuccess = null,
    ) {
        DB::beginTransaction();

        try {
            return tap($callback(), function ($result) use ($onSuccess) {

                if (!is_null($onSuccess)) {
                    $onSuccess($result);
                }

                DB::commit();
            });

        } catch (Throwable $e) {
            DB::rollBack();

            if (!is_null($onError)) {
                $onError($e);
            }

            throw new TransactionException($e);
        }
    }
}
