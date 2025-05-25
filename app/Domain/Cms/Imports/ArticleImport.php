<?php

namespace App\Domain\Cms\Imports;

use App\Domain\Cms\Repositories\Contracts\ArticleRepository;
use App\Domain\General\Repositories\Contracts\CategoryRepository;
use App\Domain\User\Repositories\Contracts\UserRepository;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Infrastructure\AbstractImports\BaseImport;

class ArticleImport extends BaseImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    /**
     * Dummy
     *
     * @var Object
     */
    protected $rules = [
        'title'        => ['required', 'max:255'],
        'body'         => ['required', 'min:10'],
        'category'     => ['required', 'exists:categories,name'],
        'status'       => ['required', 'in:active,inactive'],
        'author'       => ['required', 'exists:users,email'],
        'image'        => ['nullable', 'image']
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
        
        $articleRepository = app()->make(ArticleRepository::class);
        $categoryRepository = app()->make(CategoryRepository::class);
        $userRepository = app()->make(UserRepository::class);

        $user = $userRepository->where('email',$row['author'])->first();

        $article = $articleRepository->create([
            'title'      => $row['title'],
            'body'       => $row['body'],
            'category'   => $row['category'],
            'author_id'  => $user->id,
            'status'     => $row['status'],
        ]);

        $category = $categoryRepository->where(['name'=>$row['category']])->first();
       
        $article->categories()->attach($category);

        return $article;
    }
}