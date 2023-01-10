
<!DOCTYPE html>
<html>
<head>
    <title>Add Clothing</title>
    <meta charset="UTF-8">
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
</head>

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
                    <span class="d-none d-sm-inline mx-1">Username</span>
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
        <div class="col py-3" style="margin-left:50px;">

          <header class="w3-container w3-xlarge">
            <h3 class="">Your Suggested Fit</h3>
          
          </header>
            <div>
              <h5>{{$weather_msg}}</h5>
              <?php foreach($outfit_data as $row) : ?>
                <div class="card" id="{{$row->id}}"style="max-width: 540px; background-color: {{$row->color}};">
                  <div class="row g-0">
                    <div class="col-md-4">
                      <img src="wardrobe/store_image/fetch_image/{{$row->id}}" class="img-fluid rounded-start" width="75">
                    </div>
                    
                    <div class="col-md-8">
                      <div class="card-body">
                        <h5 class="card-title">{{$row->user_name}}</h5>
                        <!-- <p class="card-text">Classification</p> -->
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
               
            </div>   
        <!-- <div style = "margin-left:50px">

          @foreach($outfit_descriptions as $row)
          <div>{{$row[0]}}</div>
          <div>{{$row[1]}}</div>
          @endforeach
        
        
        </div> -->

        <!-- <div class="m-3">
          <button class="btn btn-info" type="button"><a class="text-decoration-none text-black" href="{{route('generate_outfit')}}">Generate New Outfit</button>
        </div> -->
        <form method="post" action="{{ route('generate_outfit') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row m-3" style="width:30%;">
                            <label class="col-md-4" align="right">Choose a type:</label>
                            <div class="col-md-8">
                            <input type="radio" name="outfit_type" value="Neutral" checked="checked">
                            <label>Neutral</label><br>
                            <input type="radio" name="outfit_type" value="Bright">
                            <label>Bright</label><br>
                            <input type="radio" name="outfit_type" value="Dark">
                            <label>Dark</label><br>
                        </div>
                        <input class="btn btn-info m-3" type="submit" value="Find A New Fit" >
              
        </form>
        <div class="m-3" >
          <form method="post" action="{{ route('store-outfit') }}"
            enctype="multipart/form-data">
          @csrf
          @foreach ($outfit_data as $data)
          <input type='hidden' name='outfit_data[]' value='{{ $data->id }}'>
          @endforeach
        
          <input class="btn btn-info" type="submit" value="Add to Favorites" >
        
          </form>
        </div>
    
</html>