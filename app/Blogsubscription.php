<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blogsubscription extends Model
{
    public $timestamps = false;
    public static function getSubscriber($id)
    {
        $array=[];
      $sub= static::where(['blog_id'=>$id]);
      $x=$sub->get()->toArray();
     foreach( $x as $s){
         array_push($array,['email'=>$s['email'],'name'=>$s['name']]);

     }
     return $array;
      
    }
}
