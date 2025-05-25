<?php
namespace App\Domain\Interaction\Traits;

use Illuminate\Support\Str;
use App\Domain\Interaction\Repositories\Contracts\MailTemplateRepository;

trait HasMailTemplate{

    /**
     * Mail Tempate
     *
     * @var MailTemplate
     */
    private $template;

    /**
     * Mail Tempate
     *
     * @var string|undefined
     */
    public $htmlTemplate;

    /**
     * Mail Tempate
     *
     * @var string|undefined
     */
    public $subject;

    /**
     * Get Mail Type
     *
     * @return string
     */
    public function getType(){
        return $this->type;
    }
    
    /**
     * Define Template
     *
     * @return void
     */
    public function buildMailBody($placeholders = []){

        $template = app()->make(MailTemplateRepository::class)->where(['type'=> $this->getType(), 'default'=>true])->first();

        if($template){
            $this->htmlTemplate = Str::of($template->body)->replace(array_keys($placeholders),array_values($placeholders));
            $this->subject = Str::of($template->subject)->replace(array_keys($placeholders),array_values($placeholders));
        }
    }
}
