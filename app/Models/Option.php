<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $primaryKey ='s_no';
    protected $table = 'options';

    static public function getOptionData()
    {

        $OptionDetails =Option::orderByDesc('s_no')->get()->toArray() ;
        return $OptionDetails;
    }
}
