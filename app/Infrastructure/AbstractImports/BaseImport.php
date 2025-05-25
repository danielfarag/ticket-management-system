<?php
namespace App\Infrastructure\AbstractImports;

use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Facades\Validator;

abstract class BaseImport
{
    use Importable;

    /**
     * Dummy
     *
     * @var int
     */
    protected $chunkSize = 20;

    /**
     * Dummy
     *
     * @var Object
     */
    public $data;

    /**
     * Define Rules
     *
     * @var Object
     */
    protected $rules = [];

    /**
     * Dummy
     *
     * @var int
     */
    protected $batchSize = 20;


    /**
     * Set Data
     *
     * @param Object $data
     */
    public function __construct($data)
    {
        $this->data = (object) $data;
    }

    /**
     * Define Batch Size
     *
     */ 
    public function batchSize() : int
    {
        return $this->batchSize;
    }
    
    /**
     * Define Chunk Size
     *
     */ 
    public function chunkSize() : int
    {
        return $this->chunkSize;
    }

    /**
     * Get Validation Rules
     *
     */ 
    protected function rules($row)
    {
        return $this->rules;
    }

    /**
     * Validate Row
     *
     */ 
    protected function isValid($row)
    {
        $validator = Validator::make($row,$this->rules($row));

        return !$validator->fails();
    }
}