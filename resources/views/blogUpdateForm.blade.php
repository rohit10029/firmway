@extends('layout')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-sm-4">
       <?php
       if(isset($error))
       { foreach($error as $e)
        {
            echo "<p style=".'color:red'.">$e</p>"."<br>";
        }

    
    }
       ?>
      </div>
      <div class="col-sm=4">
        <div class="row">
                <div class="col-sm-12">
                    <h1>Create Blog</h1>
                </div>
            </div>
        <form action="<?=URL::to('/blog-post').'/'.$blog->id;?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-6">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        
           <input type="text" name="title"  class="form-control" value='<?= $blog->title ?>'>
                </div>
                <div class="col-sm-6">
                 <input type="file" name="file">
                
                </div>
                <img src=<?=URL::to('/')."../".$blog->file ?> width="100" height="100">
            </div>
           <br>
           <div class="row">
            <div class="col-sm-12">
                <div id="answerEditor" ><?= $blog->description ?></div>
                <textarea rows="4" id="desc" style="display:none" name="desc"><?=$blog->descripton?>S</textarea>
            </div>
           </div>
               <button type="submit" class="form-control btn btn-primary">submit</button>
        </form>
            
    </div>
      <div class="col-sm-4">
       
      </div>
    </div>
  </div>


  <script >
    
    Quill.register('modules/counter', function(quill, options) {

quill.on("text-change", function(delta, oldDelta, source)  {
    var error=0
    var text = quill.getText();
    var text1 = quill.container.firstChild.innerHTML
    $("#desc").val(text1)
    $('#answerEditor').css("overflow-y", "auto")   
       
});

});
var toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
        [ 'code-block','link'],
        [{ 'header': 1 }, { 'header': 2 }],               // custom button values
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
        [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
        [{ 'direction': 'rtl' }],                         // text direction

        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
        [{ 'align': [] }],

    ];




   
    var quill = new Quill('#answerEditor', {


        modules: {
            counter: true,
            toolbar: toolbarOptions  
        },
        theme: 'snow',

    });

</script>
@endsection;
