<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuperAdmin extends Model
{
    protected $table ='superadmin';
    protected $primaryKey='id';
    public $timestamps=false;
    public $incrementing=false;
}
