<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    public function getForeignKey()
    {
        return 'fk_customer_id';
    }

    protected $table = 'customers';
    public $timestamps = true;
}
