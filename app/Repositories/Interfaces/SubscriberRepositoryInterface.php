<?php

namespace App\Repositories\Interfaces;

interface SubscriberRepositoryInterface
{
    /**
     * Create Subscriber Interface
     *
     * @param $request
     * @return mixed
     */
    public function createSubscriber($request): mixed;
}
