<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Blog;
use App\Blogsubscription;
use Redirect;
use Auth;

class UserController extends Controller
{
    public function Signup()
    {
      if($_POST){
        $user =new User();
       try{
       
        $user->name=$_POST['name'];
        $user->email=$_POST['email'];
        $user->password=$_POST['pwd'];
        $user->token=genRandomString();
        if($user->save())
        {
          Auth::login($user);
          return Redirect::to('/');
        }
        else{
            echo "some error"; 
        }
      }
        catch(\Exception $e)
        {
          echo "some error"; 
        }
      }
      else{
        echo "not";
       }
       
    }
    public function login()
    {
      if($_POST)
      {
       
     $user=User::where(['email' => $_POST['email'], 'password' => $_POST['pwd']]); 
    
      $x=$user->get()->toArray();
      $y=User::find($x[0]['id']);
       Auth::login($y);
       if(Auth::user()->token){
        return Redirect::to('/');
       }
      }
      else{
       echo "wrong";
      }
    }
    public function home()
    {
      
      $blog=Blog::paginate(1);
     return view('home',['blog'=>$blog]);
    }
   public function blogSubscribe()
   {
     if($_POST)
     {
      
       try{
       $blogSubscribe=New Blogsubscription();
       $blogSubscribe->blog_id=$_POST['blogId'];
       $blogSubscribe->email=$_POST['email'];
       $blogSubscribe->name=$_POST['name'];
       if($blogSubscribe->save())
       {
         return json_encode(['result'=>true,"msg"=>"subscribed"]);
       }else{
        return json_encode(['result'=>false,'msg'=> "subscription not saved"]);
       }
      }
      catch(\Exception $e){
        return json_encode(['result'=>false,'msg'=>'db error or email is already there']);
      }

     }
   }
}
