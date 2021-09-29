<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class invoices extends Model
{
    use SoftDeletes;
    protected $guarded =[];

    protected $dates = ['deleted_at'];
   
    
    public function sections()
    {
        return $this->belongsTo('App\sections','section_id');
    }
}
