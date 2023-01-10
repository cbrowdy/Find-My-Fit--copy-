<!DOCTYPE html>
<html>
<head>
<title>MyWardrobe</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="https://e7.pngegg.com/pngimages/230/608/png-clipart-web-design-web-development-tomsher-technologies-industry-cyan-blue-angle.png">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="{{ asset('js/app.js') }}" defer></script>
<style>
.w3-sidebar a {font-family: "Roboto", sans-serif}
body,h1,h2,h3,h4,h5,h6,.w3-wide {font-family: "Montserrat", sans-serif;}
</style>
</head>
<body class="w3-content" style="max-width:100%">

<!-- Top menu on small screens -->
<header class="w3-bar w3-top w3-hide-large w3-black w3-xlarge">
  <div class="w3-bar-item w3-padding-24 w3-wide">FindMyFit</div>
  <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding-24 w3-right" onclick="w3_open()"><i class="fa fa-bars"></i></a>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" >

  <!-- Push down content on small screens -->
  <div class="w3-hide-large" style="margin-top:83px"></div>
  
    <!-- Horizontal nav bar-->
  <div class="w3-bar w3-black">
    <a href="{{route('outfit_generation_page')}}" class="w3-bar-item w3-button">Outfit Generator</a>
    <a href="{{route('wardrobe')}}" class="w3-bar-item w3-button">Wardrobe</a>
    <a href="{{route('register')}}" class="w3-bar-item w3-button">Log in/ Register</a>
    <!--<a href="{{route('logout')}}" class="w3-bar-item w3-button">Log out</a>-->
    <!-- Register -->
    {{-- @if (Route::has('login'))
               <div>
                    @auth --}}
                        
                    {{-- @else --}}
                       

                        {{-- @if (Route::has('register')) --}}
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        {{-- @endif --}}

                        <!-- Logout -->
    <form method="POST" action="{{ route('logout') }}">
      @csrf

      <x-responsive-nav-link :href="route('logout')"
      onclick="event.preventDefault(); this.closest('form').submit();">
          {{ __('Log Out') }}
      </x-responsive-nav-link>
  </form>
                    {{-- @endauth --}}
                {{-- </div> --}}
            {{-- @endif --}}
    
  </div>
  <!-- Top header -->
  <header class="w3-container w3-xlarge">
    <p class="w3-left">Outfit Generation</p>
    <!--
    <p class="w3-right">
      <i class="fa fa-shopping-cart w3-margin-right"></i>
      <i class="fa fa-search"></i>
    </p>
-->
  </header>

  <!-- Image header -->
  <!--
  <div class="w3-display-container w3-container">
    <img src="/w3images/jeans.jpg" alt="Jeans" style="width:100%">
    <div class="w3-display-topleft w3-text-white" style="padding:24px 48px">
      <h1 class="w3-jumbo w3-hide-small">New arrivals</h1>
      <h1 class="w3-hide-large w3-hide-medium">New arrivals</h1>
      <h1 class="w3-hide-small">COLLECTION 2016</h1>
      <p><a href="#jeans" class="w3-button w3-black w3-padding-large w3-large">SHOP NOW</a></p>
    </div>
  </div>
-->
<div style="margin-left:50px">
  <div id="weather">
      <div id="description"></div>
      <h1 id="temp"></h1>
      <div id="location"></div>
  </div>
  <label for="Name"></label>
  <input type="text" id="Name" name="Name">
  <p>Click the button to submit city name (try "University City" or "Miami")</p>

  <button type="submit" id="loc" onclick="showPosition(document.getElementById('Name').value)">Get current weather conditions</button>

  <p id="demo"></p>
  
  <p>Enter the weather conditions to generate a suitable outfit</p>


  <form name="store_weather" id="store_weather" method="post" action="{{route('store_weather')}}">
    @csrf
     
     {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
   </form>

</div>

<div class="container">
    <form method="post" action="{{ route('generate_outfit') }}"
          enctype="multipart/form-data">
          @csrf
          <div class="row">
              <label class="col-md-4" align="right">Choose a type:</label>
              <div class="col-md-8">
              <input type="radio" name="outfit_type" value="Neutral" checked="checked">
              <label>Neutral</label><br>
              <input type="radio" name="outfit_type" value="Bright">
              <label>Bright</label><br>
              <input type="radio" name="outfit_type" value="Dark">
              <label>Dark</label><br>
          </div>
          <input type="submit" value="Generate Outfit" >
 
    </form>
</div>

<!-- Newsletter Modal -->
{{-- <div id="newsletter" class="w3-modal">
  <div class="w3-modal-content w3-animate-zoom" style="padding:32px">
    <div class="w3-container w3-white w3-center">
      <i onclick="document.getElementById('newsletter').style.display='none'" class="fa fa-remove w3-right w3-button w3-transparent w3-xxlarge"></i>
      <h2 class="w3-wide">NEWSLETTER</h2>
      <p>Join our mailing list to receive updates on new arrivals and special offers.</p>
      <p><input class="w3-input w3-border" type="text" placeholder="Enter e-mail"></p>
      <button type="button" class="w3-button w3-padding-large w3-red w3-margin-bottom" onclick="document.getElementById('newsletter').style.display='none'">Subscribe</button>
    </div>
  </div>
</div> --}}

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js">
// Accordion 
function expandCat(cat) {
    if (cat == 1){
        var x = document.getElementById("Season");
    }
    else if (cat == 2) {
        var x = document.getElementById("Top");
    }
    else if (cat == 3) {
        var x = document.getElementById("Bottom");
    }
  if (x.className.indexOf("w3-show") == -1 && cat == 1) {
    x.className += " w3-show";
  } 
  else if (x.className.indexOf("w3-show") == -1 && cat == 2) {
    x.className += " w3-show";
  } 
  else {
    x.className = x.className.replace(" w3-show", "");
  }
}
// Click on the "Jeans" link on page load to open the accordion for demo purposes
document.getElementById("myBtn").click();
// Open and close sidebar
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("myOverlay").style.display = "none";
}


</script>

<script lang="text/javascript">
    var x = document.getElementById("demo");
    function getLocation() {
      alert("ahhh")
      //event.preventDefault(); 
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, onError);
        alert("ahh3")
      } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
        alert("ahhh2")
      }
    }
    function onError(error) {
      var txt;
      switch(error.code)
      {
        case error.PERMISSION_DENIED:
        txt = 'Location permission denied';
        break;
        case error.POSITION_UNAVAILABLE:
        txt = 'Location position unavailable';
        break;
        case error.TIMEOUT:
        txt = 'Location position lookup timed out';
        break;
        default:
        txt = 'Unknown position.'
      }
      alert(txt)
    }


    function showPosition(position) {
      // x.innerHTML = "Latitude: " + position.coords.latitude + 
      // "<br>Longitude: " + position.coords.longitude;
      // long = position.coords.longitude
      // lat = position.coords.latitude
      
      var cityName = position
      var key = '4b8e7bbc342f87a6e521860430a27b2b';
      //fetch('https://api.openweathermap.org/data/2.5/weather?lat=' + lat + '&lon=' + long +'&appid=' + key)  
      fetch('https://api.openweathermap.org/data/2.5/weather?q=' + cityName +'&appid=' + key)  
      .then(function(resp) { return resp.json() }) // Convert data to json
      .then(function(data) {

        drawWeather(data)

      })
    }
  

    function drawWeather( d ) {
      //var celcius = Math.round(parseFloat(d.main.temp)-273.15);
      var fahrenheit = Math.round(((parseFloat(d.main.temp)-273.15)*1.8)+32); 
      
      document.getElementById('description').innerHTML = d.weather[0].description;
      document.getElementById('temp').innerHTML = fahrenheit + '&deg;';
      document.getElementById('location').innerHTML = d.name;

      var description = document.getElementById('description').innerHTML;
      var temp = document.getElementById('temp').innerHTML;
      var location = document.getElementById('location').innerHTML;
      
      axios.post('/store_weather', {
            // headers: {
            //   'X-Requested-With': 'XMLHttpRequest',
            //   'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            // },
                description: description,
                temp: temp,
                location: location
            })
            .then(function (response) {
                // console.log(response.data);
                console.log('success');
            })
            .catch(function (error) {
                // console.log(error.response.data);
                console.log('error');
            });
      
    }
   
  </script>

</body>
</html>