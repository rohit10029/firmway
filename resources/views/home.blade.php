@extends('layout')
@section('content')
 
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
          <table class="table table-striped">
              <tr>
                  <td>title</td>
                  <td>description</td>
                  <td>image</td>
                </tr>
         <?php
            foreach($blog as $b)
            { ?>
            <tr>
                <td><?=$b->slug?></td>
                <td><?= shortText($b->description)?></td>
                <td>
                  <img src=<?=URL::to('/')."../".$b->file ?> width="100" height="100">
                </td>
                <td>
                  <a href=<?= Url::to('/blog-update').'/'.$b->id ?>>update</a>
                </td>
                <td>
                  <a href=<?= Url::to('/blog-view').'/'.$b->id ?>>view</a>
                </td>
                <td>
                  <?php $flag= $b->flag==1?'green':'red' ;
                  
                  ?>
                 <a href="#" class="flag" data-key=<?=$b->id?>><i class="fa fa-flag-o child"  style="font-size:48px;color:<?=$flag?>" ></i></a>
                </td>
                <td>
                  <button id="sub" data-key=<?=$b->id?>> subscribe</button>
                </td>
            </tr>
                
            <?php } ?>
          </table>
          {!! $blog->links() !!}
      </div>
      
    </div>
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
    
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">blog subscribe</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-sm-4">
            <input type="email" name='email' id='email' placeholder="email">
              </div>
            <div class="col-sm-4">
            <input type="text" name='name' id='name' placeholder="name">
            </div>
            <div class="col-sm-4">
            <button id="submit"> subscribe</button>
            </div>
              </div>
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
    
      </div>
    </div>
  </div>
  <script>
    let blogId="";
    $("#sub").on('click',function(){
      blogId=$(this).data('key');
      $('#myModal').modal()
    })
    $("#submit").on('click',function(){
      var email=$("#email").val();
      var name=$("#name").val();
      
      $.ajax ({
        type:"POST",
       url:"<?= Url::to('/blog-subscribe')?>" ,
       data:{'email':email,'name':name,'blogId':blogId,'_token':"{{ csrf_token() }}"},
      success:function(res)
      {
        var m=JSON.parse(res)
        if(m.result)
        {
            alert("saved")
            $('#myModal').modal()
        }
        else{
        
          alert("not saved"+m.msg)
          $('#myModal').modal()
        }

      }
         })
    })

    $(".flag").on('click',function()
    {
      
      let k=$(this).data('key')
      let obj=$(this)
      $.ajax ({
        type:"GET",
       url:"<?= Url::to('/blog-publish').'/'?>"+k ,
       data:{},
      success:function(res)
      {
        var m=JSON.parse(res)
        if(m.result)
        {
          
          obj.find('.child').css('color',m.color)
        }
        else{
          
          obj.find('.child').css('color','red')
        }

      }
         })
    })
   
    </script>
@endsection;
