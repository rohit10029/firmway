<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Blog;  
use App\jobs\sendEmail; 
use App\Blogsubscription;
use Redirect;
use Auth;
use Mail;

class BlogController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
    public function blogForm()
    {
        return view('BlogForm');
    }
    public function blogSubmit($x=null)
    {
      
       if($_POST)
       {
           $error=[];
        if($_FILES["file"]["error"] != 4)
        {
          if($_FILES['file']['size'] > 10485760)
          {
             
            array_push($error,'file size is more');
          }
          else{
            $allowed = array('gif', 'png', 'jpg');
            $filename = $_FILES['file']['name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if (!in_array($ext, $allowed)) {
                array_push($error,'file type not allowed');
               
               }
               else{
                $filename   = uniqid() . "-" . time(); // 5dab1961e93a7-1571494241
                $extension  = pathinfo( $_FILES["file"]["name"], PATHINFO_EXTENSION ); // jpg
                $basename   = $filename . "." . $extension; // 5dab1961e93a7_1571494241.jpg
                
                $source       = $_FILES["file"]["tmp_name"];
                $destination  = "../storage/app/public/images/{$basename}";
                if(move_uploaded_file($source, $destination))
                {
                   
                   
                   
                }
                else{
                    array_push($error,'file type not uploded');
                }
               }
          }
        }
        if(empty($_POST['title']) && empty($_POST['desc']))
        {
            array_push($error,'All field are mandatory');
        }
        if(count($error))
        {
          if($x!=null)
          {
            $blog=Blog::find($x);
            return view('BlogUpdateForm',['blog'=>$blog,'error'=>$error]);
          }
          
            return view('BlogForm',['error'=>$error]);
           
        }
        else{
          if($x!=null)
          {
            $blog=Blog::find($x);
            if($blog->user_id== Auth::user()->id)
            {
              $blog->title=$_POST['title'];
              $blog->slug= properSlug($_POST['title']);
              $blog->description=$_POST['desc'];
              if(isset($destination))
              {
                $blog->file=$destination;
              }
              
              if( $blog->save())
              {
               $d= Blogsubscription::getSubscriber($blog->id);
                foreach($d as $e)
                {
                   dispatch(new SendEmail($e));
                }

                 return Redirect::to('/blog-update'.'/'.$x);
              }
              else{
                unlink($destination);
              }
            }
            else{
              echo "you are not allowed ";
            }
           
          }
          else{
            $blog=new Blog();
            $blog->title=$_POST['title'];
            $blog->user_id=Auth::user()->id;
            $blog->slug= properSlug($_POST['title']);
            $blog->description=$_POST['desc'];
            $blog->file=$destination;
            if( $blog->save())
            {
              return Redirect::to('/blog-update'.'/'.$blog->id);
            }
            else{
              unlink($destination);
            }
        }
            
        }
           
           
           
       }
    }
     
    public function blogUpdate($id)
    {
        if($id)
        {
            $blog=Blog::find($id);
            return view('BlogUpdateForm',['blog'=>$blog]);
            
        }
       
    }
    public function blogView($id)
    {
    
     
      
        if($id!=null)
        {
            $blog=Blog::find($id);
            
            if($blog->flag==1)
            {
              return view('blogView',['blog'=>$blog]);
            }
            else{
              echo "flaged content";
            }
            
        }
       
    }
    public function blogPublish($id)
    {
      if($id!=null)
      {
        $blog=Blog::find($id);
        if($blog->user_id==Auth::user()->id)
        {
          $color=$blog->flag==1?'green':'red';
          $blog->flag=$blog->flag==1?0:1;
          if( $blog->save()){
            return json_encode(['result'=>true,'msg'=>'saved','color'=>$color]);
          }
          else{
            return json_encode(['result'=>false,'msg'=>' not saved']);
          }
        }
        else{
          return json_encode(['result'=>false,'msg'=>'you are not allowed']);
        }

      }
    }
}
