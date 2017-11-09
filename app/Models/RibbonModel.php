<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RibbonModel extends Model
{
    public $table = 'ribbons';

    public function getLogoUrl()
    {
        $metaData = json_decode($this->meta_data);
        return $metaData->logo_url;
    }
}
