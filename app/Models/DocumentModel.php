<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentModel extends Model
{
    public $table = 'documents';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'content',
        'meta_data',
        'ribbon_id',
        'source_url',
        'published_at',
    ];

    public function getAnnotation()
    {
        $content = $this->content;
        $content = strip_tags($content);
        $annotationParts = explode(' ', $content);
        $annotationParts = array_slice($annotationParts, 0, 100);
        $annotation = implode(' ', $annotationParts);
        return $annotation;
    }

    public function getCleanContent()
    {
        $content = strip_tags($this->content, '<img><p><strong><ul><ol><li><br>');
        return $content;
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

    public function getEscapedFragmentUrl()
    {
        return '/post/?_escaped_fragment_=' . $this->id;
    }

    public function getUrl()
    {
        return $this->getEscapedFragmentUrl();
    }
}
