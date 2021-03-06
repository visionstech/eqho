<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;

class LanguagePackage extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','name','description','price_per_word','updated_by','updated_ip'];

}
