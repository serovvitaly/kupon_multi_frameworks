<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentModel extends Model
{
    public $table = 'documents';

    public $timestamps = false;

    public function getAnnotation()
    {
        $content = strip_tags($this->content, '<img><p><strong>');
        $annotationParts = explode(' ', $content);
        $annotationParts = array_slice($annotationParts, 0, 100);
        $annotation = implode(' ', $annotationParts);
        return $annotation;
    }

    /**
     * Возвращает url на оригинал(источник) статьи
     * @return string
     */
    public function getSourceUrl()
    {
        $metaData = json_decode($this->meta_data);
        return $metaData->source_url;
    }

    /**
     * Возвращает хост(домен), сайта(источника) стать
     * @return string
     */
    public function getSourceBaseUrl()
    {
        $sourceUrlParts = parse_url($this->getSourceUrl());
        return $sourceUrlParts['host'];
    }

    public function getUrl()
    {
        return '/post/' . $this->id . '/';
    }
}
