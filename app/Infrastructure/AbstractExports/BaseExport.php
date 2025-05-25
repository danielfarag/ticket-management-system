<?php
namespace App\Infrastructure\AbstractExports;
use Illuminate\Support\Collection;

abstract class BaseExport
{
    /**
     * Dummy
     *
     * @var Object
     */
    protected $model = null;

    /**
     * Dummy
     *
     * @var boolean
     */
    protected $dummy = true;

    /**
     * Dummy
     *
     * @var Object
     */
    protected $faker = null;

    /**
     * Define
     *
     * @param boolean $dummy
     */
    public function __construct($dummy = true){
        $this->dummy = $dummy;
        $this->faker = \Faker\Factory::create();
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if($this->dummy){
            return new Collection([
                [],
                [],
                [],
                [],
                [],
                [],
                [],
                [],
                [],
                [],
            ]);
        }
        if($this->model){
            $records = app()->make($this->model)->all();
        }else{
            $records = $this->query()->get();
        }
        return $records;
    }

    /**
    * Return Data
    */
    public function map($model): array
    {
        if($this->dummy){
            return $this->dummy();
        }else{
            return $this->real($model);
        }
    }

    /**
    * Return Heading
    */
    public function headings(): array
    {
        if($this->dummy){
            return array_keys($this->dummy());
        }else{
            return array_keys($this->real(new FakeModel));
        }
    }

    /**
    * Return Dummy Data
    */
    abstract function dummy();


    /**
    * Return Real Data
    */
    abstract function real($model);
}

class FakeModel{
    public function __get($val){
        return null;
    }
}