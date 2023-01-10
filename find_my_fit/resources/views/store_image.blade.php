
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
#display-image{
  width: 100px;
  height: 80px;
  background-position: center;
  background-size: cover;
  margin-left: 60px;
}
body,h1,h2,h3,h4,h5,h6,.w3-wide {
  font-family: "Montserrat", sans-serif;
}
#photos {
   /* Prevent vertical gaps */
   line-height: 0;
   
   -webkit-column-count: 4;
   -webkit-column-gap:   30px;
   -moz-column-count:    4;
   -moz-column-gap:      30px;
   column-count:         4;
   column-gap:           30px;
   orphans: 3;
   
}

#imgphoto {
  /* Just in case there are inline attributes */
  width: 100% !important;
  height: auto !important;
  overflow: visible;
}
    </style>
</head>
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
            <div class="container">    
              <br />
              <h3 align="center">Insert Image into Wardrobe</h3>
                  <br />
                  @if($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                      @foreach($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                      </ul>
                      </div>
                  @endif

                  @if(session()->has('success'))
                  <div class="alert alert-success">
                  {{ session()->get('success') }}
                  </div>
                  @endif
                  <br />

                  <div class="panel panel-default">
                    <div class="panel-body">
                          <br />
                        <form method="post" action="{{ url('store_image/insert_image') }}"  enctype="multipart/form-data">
                          @csrf
                          <div class="form-group">
                              <div class="row">
                              <label class="col-md-4" align="right">Enter Info</label>
                                  <div class="col-md-8">
                                      <input type="text" name="user_name" class="form-control" />
                                  </div>
                              </div>
                          </div>
                          <br />
                          <div class="form-group">
                              <div class="row">
                              <label class="col-md-4" align="right">Select Image</label>
                                  <div class="col-md-8">
                        
                                      <!-- <input type="file" name="user_image"/> -->
                                      <div class="mb-3">
                                          <input class="form-control" name="user_image" type="file" id="formFile">
                                      </div>
                                      <!-- <div class="col-md-8" id="display-image"></div> -->
                                      
                                      <script>
                                        const image_input = document.querySelector("#formFile");
                                        image_input.addEventListener("change", function() {
                                          const reader = new FileReader();
                                          reader.addEventListener("load", () => {
                                            const uploaded_image = reader.result;
                                            document.querySelector("#display-image").style.backgroundImage = `url(${uploaded_image})`;
                                          });
                                          reader.readAsDataURL(this.files[0]);
                                        });

                                      </script>
                        
                                      
                            
                              </div>
                          </div>
                          <br />
                          
                          <div class="form-group">
                              <div class="row">
                                  <label class="col-md-4" align="right">Choose a type:</label>
                                  <div class="col-md-8">
                                      <input class="form-check-input" type="radio" name="type" value="Innerwear">
                                      <label class="form-check-label">Innerwear</label><br>
                                      <input class="form-check-input" type="radio" name="type" value="Outterwear">
                                      <label class="form-check-label">Outterwear</label><br>
                                      <input class="form-check-input" type="radio" name="type" value="Bottom">
                                      <label class="form-check-label">Bottom</label><br>
                                      <input class="form-check-input" type="radio" name="type" value="Shoes">
                                      <label class="form-check-label">Shoes</label>
                                  </div>
                              </div>  
                          </div>
                          <br />
                          <div class="form-group">
                          <div class="row">
                              <label class="col-md-4" align="right">Choose a color:</label>
                              <div class="col-sm-2">
                                  <input type="color" class="form-control form-control-color" id="color" name="color" value="#000000"><br><br>
                              </div>
                              <div class="col-sm-2" id="display-image"></div>
                          </div>  
                          </div>
                          <br />
                          
                          <div class="form-group" align="center">
                          <br />
                          <br />
                          
                          <input type="submit" name="store_image" class="btn btn-info" value="Upload" />
                          
                          </div>
                        </form>
                  </div>
                  </div>
                </div> 
                
            </div>
        </div>
</div>
</body>
</html>
