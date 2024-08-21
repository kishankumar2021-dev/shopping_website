<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subcategory extends Model
{
    use HasFactory;
    protected $table = "sub_categories";

    protected $primaryKey = "sub_cat_id";

    static public function getSubCategory()
    {
        $Categoris = subcategory::where('show_in_header','=',1)->get()->toArray();
        return $Categoris;
    }

}
