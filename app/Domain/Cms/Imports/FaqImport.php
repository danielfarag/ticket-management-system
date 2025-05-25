<?php

namespace App\Domain\Cms\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Infrastructure\AbstractImports\BaseImport;
use App\Domain\Cms\Repositories\Contracts\FaqRepository;
use App\Domain\Cms\Repositories\Contracts\ArticleRepository;
use App\Domain\Ticket\Repositories\Contracts\DepartmentRepository;

class FaqImport extends BaseImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    /**
     * Dummy
     *
     * @var Object
     */
    protected $rules = [
        'question'      => ['required', 'string', 'max:255'],
        'answer'        => ['required', 'string', 'max:255'],
        'department'    => ['required', 'exists:departments,name'],
        'article'       => ['nullable', 'exists:articles,title'],
        'status'        => ['required', 'in:active,inactive'],
    ];

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(!$this->isValid($row)){
            return null;
        }

        $faqRepository = app()->make(FaqRepository::class);
        $articleRepository = app()->make(ArticleRepository::class);
        $departmentRepository = app()->make(DepartmentRepository::class);

        $article = $articleRepository->where('title', $row['article'])->first();
        $department = $departmentRepository->where('name', $row['department'])->first();

        $faq = $faqRepository->create([
            'question'        => $row['question'],
            'answer'          => $row['answer'],
            'department_id'   => $department->id,
            'article_id'      => optional($article)->id,
            'status'          => $row['status'],
        ]);

        return $faq;
    }
}