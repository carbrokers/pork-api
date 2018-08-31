<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class ArtsCatgsRelation extends Model
{
    //
    protected $table = 'arts_catgs';
    protected $fillable = ['article_id','category_id'];

    static public function bactchAdd($articleId,$categoryIds)
    {
        $data = array_map(function($item) use($articleId) {
            return [
                'article_id' => $articleId,
                'category_id' => $item
            ];
        },$categoryIds);
        return DB::table('arts_catgs')->insert($data);
    }

}
