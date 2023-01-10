<!DOCTYPE html>
<html>
<head>
    <title>Fit Me</title>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="https://e7.pngegg.com/pngimages/230/608/png-clipart-web-design-web-development-tomsher-technologies-industry-cyan-blue-angle.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>

body,h1,h2,h3,h4,h5,h6,.w3-wide {
  font-family: "Montserrat", sans-serif;
}

    </style>
<body>

  <div class="container-fluid">
      <div class="row flex-nowrap">
          <div class="min-vh-100 col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-light sticky-top">
             <div class="d-flex flex-sm-column flex-row flex-nowrap bg-light align-items-center sticky-top">
                <a class="d-block p-3 link-dark text-decoration-none">
                  <span id="logo" class="text-secondary fs-2 w3-wide d-none d-sm-inline">FindMyFit</span>
                </a>
                <ul class="nav nav-pills nav-flush flex-sm-column flex-row flex-nowrap mb-auto mx-auto text-center align-items-center" id="menu">
                  <li class="nav-item">
                    <a href="/wardrobe/all" class="text-info nav-link align-middle py-3 px-2">
                        <i class="fs-2 bi-house"></i> <span class="fs-4 ms-1 d-none d-sm-inline">Wardrobe</span>
                    </a>
                  </li>
                  <li>
                    <a href="/fitme" class="text-info nav-link py-3 px-2 align-middle">
                      <i class="fs-2 bi-table"></i> <span class="fs-4 ms-1 d-none d-sm-inline">Fit Me</span></a>
                  </li>
                  <li>
                    <a href="/social_page" class="text-info nav-link py-3 px-2 align-middle">
                      <i class="fs-2 bi-compass"></i> <span class="fs-4 ms-1 d-none d-sm-inline">Discover</span></a>
                  </li>
                  
                </ul>
                
                <div class="position-fixed pb-4" style="bottom: 0px">
                  <a href="#" class=" text-secondary d-flex align-items-center text-decoration-none dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fs-2 bi-person-circle"></i>
                    <span class="d-none d-sm-inline mx-1">{{ $username }}</span>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/account">Profile</a></li>
                    <li><form class="dropdown-item text-decoration-none" method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                            {{-- @endauth --}}
                        {{-- </div> --}}
                    {{-- @endif --}}
                    </li>
                  </ul>
                </div>
              </div>
          </div>
        <div class="col py-3">
            <div style="margin-left:50px; width:50%">
                <div id="weather">
                    <div id="description"></div>
                    <h1 id="temp"></h1>
                    <div id="location"></div>
                </div>
                <label for="Name"></label>
                <h5 class="mb-3">Click the button to submit city name (try "Miami")</h5>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Your Location</span>
                    </div>
                    <input id="Name" type="text" class="form-control" placeholder="City Name" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                

                <button class="btn btn-light"type="submit" id="loc" onclick="showPosition(document.getElementById('Name').value)">Push Weather Data</button>

                <p id="demo"></p>

                <form name="store_weather" id="store_weather" method="post" action="{{route('store_weather')}}">
                    @csrf
                    <div style="display:none">
                      <div class="form-group">
                          <label for="temp">Temperature:</label>
                          <input type="text" id="temp2" name="temp" class="form-control" required="">
                      </div>
                      <div class="form-group">
                          <label for="temp">Description:</label>
                          <input type="text" id="description2" name="description" class="form-control" required="">
                      </div>
                      <div class="form-group">
                          <label for="temp">Location:</label>
                          <input type="text" id="location2" name="location" class="form-control" required="">
                      </div>
                    </div>
                    <button style="display:none"type="submit" class="btn btn-primary" >Submit</button>
                </form>

                @if(session()->has('failure'))
                <div class="alert alert-danger">
                {{ session()->get('failure') }}
                </div>
                @endif

                  <form method="post" action="{{ route('generate_outfit') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mt-3">
                            <label class="" align="right">Choose a type:</label>
                            <div class="col-md-8">
                            <input type="radio" name="outfit_type" value="Neutral" checked="checked">
                            <label>Neutral</label><br>
                            <input type="radio" name="outfit_type" value="Bright">
                            <label>Bright</label><br>
                            <input type="radio" name="outfit_type" value="Dark">
                            <label>Dark</label><br>
                        </div>
                        <input class="btn btn-info mt-3 btn-lg" type="submit" value="Find My Fit" >
              
                  </form>
             
                <!-- <button onclick="location.href='/generated_outfit'">
                   
                    <span class="fs-4 ms-1 d-none d-sm-inline">Create Fit</span>
                </button> -->
            <!-- <button type="button"><a href="{{route('generate_outfit')}}">Generate Outfit</button> -->
            </div>
 
        </div>
    </div>


  <script>
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
      
      //document.getElementById('description').innerHTML = d.weather[0].description;
      //document.getElementById('temp').innerHTML = fahrenheit + '&deg;';
      //document.getElementById('location').innerHTML = d.name;
      document.getElementById('description2').value = d.weather[0].description;
      document.getElementById('temp2').value = fahrenheit;
      document.getElementById('location2').value = d.name;
      document.getElementById("store_weather").submit();
    }
 
   
  </script>
</body>
</html>



