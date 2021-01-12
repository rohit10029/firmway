<html>
  <head>
    <title>User signup</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.rawgit.com/jackmu95/52b82e3ec79a2e2a30ddf37e71846711/raw/6e6ee157a7d1ca7c97d81de7d61a9ee2536a7d46/quill.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
  <div>
   
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="#"><?=
              Auth::user()!=null?"Wellcome!.." .Auth::user()->name:"Wellcome!.. guest"
              ?></a>
          </div>
          <ul class="nav navbar-nav">
            <li class="active"><a href=<?= Url::to('/')?>>Home</a></li>
            <?php if(Auth::user()==null){ ?>
            <li><a href=<?= Url::to('/login')?>>login</a></li>
            <?php }else{ ?>
              <li><a href=<?= Url::to('/blog')?>>create blog</a></li>
              <?php }?>
          </ul>
        </div>
      </nav>
  </div>
  @yield('content')
</body>

</html>