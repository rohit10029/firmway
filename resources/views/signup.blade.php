@extends('layout')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-sm">
       
      </div>
      <div class="col-sm">
        <div class="form" >
      
          <ul class="tab-group">
            <li class="tab active btn btn-primary"><a href="#signup">Sign Up</a></li>
            <li class="tab"><a href="#login">Log In</a></li>
          </ul>
          
          <div class="tab-content">
            <div id="signup">   
              <h1>Sign Up for Free</h1>
              
              <form action="<?=URL::to('/signup');?>" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
              <div class="top-row">
                <div class="field-wrap">
                  <div class="row">
                  <div class="col-sm-4">
                    <label>
                      Name<span class="req">*</span>
                    </label>
                  </div>
                  <div class="col-sm-4">
                    <input type="text" name="name" required autocomplete="off" />
                  </div>
                  </div>
                </div>
            
                
              </div>
      
              <div class="field-wrap">
                <div class="row">
                  <div class="col-sm-4">
                    <label>
                      Email Address<span class="req">*</span>
                    </label>
                  </div>
                  <div class="col-sm-4">
                    <input type="email" name="email" required autocomplete="off"/>
                  </div>
                  </div>
               
               
              </div>
              
              <div class="field-wrap">
                <div class="row">
                  <div class="col-sm-4">
                    <label>
                      Set A Password<span class="req">*</span>
                    </label>
                  </div>
                  <div class="col-sm-4">
                    <input type="password" name="pwd" required autocomplete="off"/>
                  </div>
                  </div>
               
                
              </div>
              
              <button type="submit" class="btn btn-primary">Get Started</button>
              
              </form>
      
            </div>
            
            <div id="login" style=" display:none">   
              <h1>Welcome Back!</h1>
              
              <form action="<?=URL::to('/join');?>" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="field-wrap">
                  <div class="row">
                    <div class="col-sm-4">
                      <label>
                        Email Address<span class="req">*</span>
                      </label>
                    </div>
                    <div class="col-sm-4">
                      <input type="email"required autocomplete="off" name="email"/>
                    </div>
                    </div>
               
                
              </div>
              
              <div class="field-wrap">
                <div class="row">
                  <div class="col-sm-4">
                    <label>
                      Password<span class="req">*</span>
                    </label>
                  </div>
                  <div class="col-sm-4">
                    <input type="password"required autocomplete="off" name="pwd"/>
                  </div>
                  </div>
               
                
              </div>
              
              
              <button class="btn btn-primary" type="submit">Log In</button>
              
              </form>
      
            </div>
            
          </div><!-- tab-content -->
          
      </div>
      </div>
      <div class="col-sm">
       
      </div>
    </div>
  </div>
  

  <script >
    

$('.tab a').on('click', function (e) {
  
  e.preventDefault();
  
  $(this).parent().addClass('btn btn-primary');
  $(this).parent().siblings().removeClass('btn btn-primary');
  
  target = $(this).attr('href');

  $('.tab-content > div').not(target).hide();
  
  $(target).fadeIn(600);
  
});
    </script>

@endsection;