<?php

namespace Domain\Auth\Services;

use Domain\Auth\Exceptions\SubscriptionException;
use Domain\Auth\Models\Collector;
use Illuminate\Support\HigherOrderTapProxy;
use Support\Exceptions\TransactionException;
use Support\Transaction;
use Throwable;

class CollectorSubscriptionService
{
    protected ?Collector $subscriber;

    public function __construct()
    {
        $this->subscriber = auth('collector')->user();
    }

    /**
     * @throws SubscriptionException|TransactionException
     */
    public function subscribe(Collector $collector, Collector $subscriber = null): bool|HigherOrderTapProxy
    {

        $subscriber = $subscriber ?? $this->subscriber;
//        dd($subscriber);

        if (!$subscriber || $subscriber->id === $collector->id) {
            return false;
        }

        if ($this->isSubscribed($collector, $subscriber)) {
            return true;
        }

        return Transaction::run(
            function () use ($collector, $subscriber) {
                $collector->subscribers()->attach($subscriber);
                return true;
            },
            function (Throwable $e) {
                throw new SubscriptionException($e->getMessage());
            }
        );
    }

    /**
     * @throws SubscriptionException|TransactionException
     */
    public function unsubscribe(Collector $collector, Collector $subscriber = null): bool|HigherOrderTapProxy
    {
        $subscriber = $subscriber ?? $this->subscriber;

        if (!$subscriber || $subscriber->id === $collector->id) {
            return false;
        }

        if (!$this->isSubscribed($collector, $subscriber)) {
            return true;
        }

        return Transaction::run(
            function () use ($collector, $subscriber) {
                $collector->subscribers()->detach($subscriber);
                return true;
            },
            function (Throwable $e) {
                throw new SubscriptionException($e->getMessage());
            }
        );
    }

    protected function isSubscribed(Collector $collector, Collector $subscriber): bool
    {
        return $collector->subscribers()
            ->where('subscriber_id', $subscriber->id)
            ->exists();
    }
}
