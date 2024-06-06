<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;

abstract class DbQueueWorker
{
    protected $operationQueue = [];

    public function __construct()
    {
        $this->operationQueue = collect();
    }

    public abstract function run();

    protected function push(\Closure $operation)
    {
        $this->operationQueue->push($operation);
    }

    protected function execute()
    {
        DB::beginTransaction();
        try
        {
            $results[] = $this->operationQueue->each(
                fn($operation) => $operation()
            );

            DB::commit();
            return $results ;

        }
        catch (\Exception $exception )
        {
            DB::rollBack();
            throw $exception;
        }

    }


}
