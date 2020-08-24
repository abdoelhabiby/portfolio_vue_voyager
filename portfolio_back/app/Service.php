<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Service extends Model
{
	   public function getImageAttribute($image)
    {
       $fiximage = explode('.', $image);
       $fiximage[0] = $fiximage[0] . "-medium";

       return implode('.', $fiximage);
    }
    
}
