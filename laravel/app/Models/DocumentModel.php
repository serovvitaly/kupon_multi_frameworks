<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentModel extends Model
{
    public $table = 'documents';

    public function getAnnotation()
    {
        $content = strip_tags($this->content, '<img><p><strong>');
        $annotationParts = explode(' ', $content);
        $annotationParts = array_slice($annotationParts, 0, 100);
        $annotation = implode(' ', $annotationParts);
        return $annotation;
    }
}
