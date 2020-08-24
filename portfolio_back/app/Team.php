<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Team extends Model
{
      //protected $fillabel =['image'];

    public function getImageAttribute($image)
    {
       $fiximage = explode('.', $image);
       $fiximage[0] = $fiximage[0] . "-medium";

       return implode('.', $fiximage);
    }
}
