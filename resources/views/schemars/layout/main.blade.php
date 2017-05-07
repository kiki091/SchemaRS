<!DOCTYPE html>
<html lang="en">
  	<head>
  	@include('schemars.include.head')
  	</head>

  	<body class="nav-md fixed">
      @include('schemars.include.notify')
  		<div class="container body">
      		<div class="main_container">
        			@include('schemars.include.sidebar')
        			@include('schemars.include.top-bar')
              <div class="main__wrapper__content">
                  <div class="right_col" role="main">
      				      @yield('content')
                  </div>
              </div>
  			   </div>
  		</div>
      <div id="custom_notifications" class="custom-notifications dsp_none">
          <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
          </ul>
          <div class="clearfix"></div>
          <div id="notif-group" class="tabbed_notifications"></div>
      </div>
      @include('schemars.include.vars')
  		@include('schemars.include.js_component')
		  @section('scripts')
      @show
  	</body>
</html>