<?php

namespace App\Services;

class ProgressmanUrlCorrector
{
    public function correctContent($content)
    {
        //
    }

    public function massCorrect()
    {
        $documents = \App\Models\DocumentModel::where([
            'ribbon_id' => 2,
        ])->get();

        foreach ($documents as $document) {
            echo 'docId: ', $document->id, PHP_EOL;
            $content = $document->content;
            $content = preg_replace_callback('/href="([^"]+)"/', function ($matches) use ($document) {
                if (empty($matches)) {
                    return null;
                }
                $url = trim($matches[1]);
                $sql = "SELECT id FROM documents WHERE meta_data->>'source_url' = :url";
                $results = \DB::select(\DB::raw($sql), [
                    'url' => $url,
                ]);
                if (empty($results)) {
                    return 'href="'.$url.'"';
                }
                $toDocId = $results[0]->id;
                $referenceUrl = \App\Models\ReferenceUrl::where([
                    'url' => $url,
                    'to_doc_id' => $toDocId,
                ])->first();
                if ($referenceUrl) {
                    return 'href="'.('/post/' . $toDocId . '/').'"';
                }
                $referenceUrl = new \App\Models\ReferenceUrl;
                $referenceUrl->url = $url;
                $referenceUrl->from_doc_id = $document->id;
                $referenceUrl->to_doc_id = $toDocId;
                $referenceUrl->save();
                return 'href="'.('/post/' . $toDocId . '/').'"';

            }, $content);
            $document->content = $content;
            $document->save();
        }
    }
}