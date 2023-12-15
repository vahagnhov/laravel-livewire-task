<?php

namespace App\Repositories;

use App\Models\Subscriber;
use App\Repositories\Interfaces\SubscriberRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SubscriberRepository implements SubscriberRepositoryInterface
{
    /**
     * Create Subscriber
     *
     * @param $req
     * @return mixed
     * @throws ValidationException
     */
    public function createSubscriber($req): mixed
    {
        $req['date_of_marriage'] = collectMysqlDateFormat(
            $req['date_of_marriage_year'],
            $req['date_of_marriage_month'],
            $req['date_of_marriage_day'],
        );
        $req['date_of_birth'] = collectMysqlDateFormat(
            $req['dob_year'],
            $req['dob_month'],
            $req['dob_day'],
        );

        try {
            // Start a database transaction
            DB::beginTransaction();

            // Create the subscriber inside the transaction
            $subscriber = Subscriber::create([
                'first_name' => $req['first_name'],
                'last_name' => $req['last_name'],
                'address' => $req['address'],
                'city' => $req['city'],
                'country' => $req['country'],
                'date_of_birth' => $req['date_of_birth'],
                'married' => $req['married'],
                'date_of_marriage' => $req['date_of_marriage'],
                'marriage_country' => $req['marriage_country'],
                'widowed' => $req['widowed'],
                'previously_married' => $req['previously_married'],
            ]);
            // Commit the transaction if everything is successful
            DB::commit();

            return $subscriber;
        } catch (\Exception $e) {
            // An error occurred, rollback the transaction
            DB::rollBack();
            // Check if Livewire is in the context
            if (app()->runningInLivewire()) {
                throw ValidationException::withMessages(
                    ['submissionError' => __('An error occurred while processing your request.Please try again.')]);
            } else {
                throw $e;
            }
        }
    }
}
