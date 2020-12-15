<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormAccept extends Model
{
    protected $table = "form_accept";
    protected $fillable=['acepto','porque'];

    public function user(){
        return $this->hasMany('App/User');
    }
}
