<?php

namespace Services\Support;

use Support\Exceptions\CrudException;
use Support\Exceptions\TransactionException;
use Support\Transaction;
use Tests\TestCase;
use Throwable;

class TransactionTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function it_success(): void
    {
        $test = Transaction::run(
            function () {
                return 1 + 1;
            },
            function (Throwable $e) {
                throw new CrudException($e->getMessage());
            }
        );

        $this->assertEquals(2, $test);
    }

    /**
     * @test
     * @return void
     */
    public function it_success_with_onSuccess(): void
    {
        $test = Transaction::run(
            function () {
                return 1 + 1;
            },
            function (Throwable $e) {
                throw new CrudException($e->getMessage());
            },
            function ($value) {
                return $value;
            }
        );

        $this->assertEquals(2, $test);
    }

    /**
     * @test
     * @return void
     */
    public function it_fail_with_exception(): void
    {
        $this->expectException(CrudException::class);

        Transaction::run(
            function () {
                return 1/0;
            },
            function (Throwable $e) {
                throw new CrudException($e->getMessage());
            }
        );
    }

    /**
     * @test
     * @return void
     */
    public function it_fail_with_default_exception(): void
    {
        $this->expectException(TransactionException::class);

        Transaction::run(
            function() {
                return 1/0;
            }
        );
    }
}
