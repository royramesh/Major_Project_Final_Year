<!DOCTYPE html>
<html>
<head>
    <title>Geolocation</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <style>
        .marker-btn {
            background-color: green;
            color: white;
            font-weight: bold;
            border: 0px solid white;
            border-radius: 5px;
            cursor: pointer;
        }
        .leaflet-marker-icon.ptn-marker {
            border:5px solid red;
        }

    </style>

</head>

<body>

    <!-- Alert box -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Alert</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h5 class="text-danger alert alert-warning" id="msg-box"></h5>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
    
    <div class="container-fluid row">

        <div class="alert-conatiner sticky-sm-top" id="alert">
        <div class="alert alert-danger mt-0 p-1 text-center mb-0 ms-0 me-0" role="alert">
        <p class="text-danger fs-5 text-decoration-none">Please login to book rides<a href="/user_login" class=""> click here</a></p>
        </div>
        </div>
        <div class="left-panel col-5 border vh-100 overflow-auto">
            <div class="patient-card-body">
                    <!-- Card header begins -->

                    <form class="row g-3 mt-5">

                    <div class="col-md-3">
                        <img src="https://cdn-icons-png.flaticon.com/256/1834/1834837.png" alt="" width="100" >
                    </div>
                    <div class="col-md-9">
                        <h2>Ambulance availability check</h2>
                    </div>
                   
                    <div class="col-12">
                    <label for="" class="form-label">Ambulance Type</label><span class="text-danger">*</span>
                    <select class="form-select" aria-label="Default select example" name="ptn_amb_type" id="amb_type">
                        <option selected="true" disabled="disabled" value="">-- Choose Ambulance --</option>
                        <option value="normal">Normal</option>
                        <option value="Life-support">Life-support</option>
                    </select>
                    </div>
               
                    <!-- City datalist -->
                    <div class="col-md-6">
                    <label for="inputCity" class="form-label">City</label><span class="text-danger">*</span>
                        <datalist id="city" >
                            @foreach($cities as $city)
                                <option value="{{$city->city_ascii}}">{{$city->city_ascii}}</option>
                            @endforeach
                        </datalist>
                        <input  autoComplete="on" list="city" class="form-control" placeholder="Choose city" name="ptn_city" id="ptn_city"/> 
                    </div>

                <!-- District datalist -->
                    <div class="col-md-6">
                        <label for="inputState" class="form-label">District</label>
                        <datalist id="district" >
                            @foreach($district as $dist)
                                <option value="{{$dist->District}}">{{$dist->District}}</option>
                            @endforeach
                        </datalist>
                        <input  autoComplete="on" list="district" class="form-control" placeholder="Choose district" name="ptn_district" id="amb_district"/>
                    </div>

                    <!-- State datalist -->

                    <div class="col-md-6">
                        <label for="inputstate" class="form-label">State</label>
                        <datalist id="state" >
                            @foreach($states as $state)
                                <option value="{{$state->States}}">{{$state->States}}</option>
                            @endforeach
                        </datalist>
                        <input  autoComplete="on" list="state" class="form-control" placeholder="Choose state" name="ptn_state" id="ptn_state"/>
                    </div>

                    <div class="col-md-6">
                        <label for="" class="form-label">Zip code</label><span class="text-danger">*</span>
                       <input type="text" class="form-control" id="ptn_zip">
                    </div>
                    <div class="col-6 d-grid gap-2">
                        <button type="button" id="check" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Check availability</button>
                    </div>
                    <div class="col-6 d-grid gap-2">
                        <button type="button" id="proceed_addrs" class="btn btn-primary">Proceed with this address</button>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="button" id="current_addrs" class="btn btn-warning"><i class="fa-solid fa-street-view"></i> Use current address</button>
                    </div>
                    
                </form>
     
                   
                    <!-- Card header ends -->
            </div>
        </div>
        <div id="map" style="width:80%; height: 100vh" class="col"></div>
    </div>

    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <script>
    
        var data;
        navigator.geolocation.getCurrentPosition(success, error);

        function success(pos) {
            var lat = pos.coords.latitude;
            var lon = pos.coords.longitude;

            var map = L.map('map').setView([lat, lon], 18);

            googleStreets = L.tileLayer('http://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }).addTo(map);

            var taxi_icon = L.icon({
                iconUrl: 'https://multidestinosexpress.co/wp-content/uploads/2022/08/22.png',
                iconSize: [50, 50]
            });

            var req = new XMLHttpRequest();
            req.open('GET', '/amb-data-json', true);
            req.send();

            req.onreadystatechange = function () {
                if (req.readyState == 4 && req.status == 200) {
                    var obj = JSON.parse(req.responseText);
                    data = obj.amb_data;
                    for (let i = 0; i < data.length; i++) {
                        var patient_marker = L.marker([data[i]['amb_loc_lat'], data[i]['amb_loc_lng']], {icon:taxi_icon, id:data[i]['amb_no'], val:i}).addTo(map); //Patient marker on map
                    }
                }
            };
            var patientIcon = L.icon({
                iconUrl: 'https://cdn3.iconfinder.com/data/icons/maps-and-navigation-7/65/68-512.png',
                iconSize: [50, 50]
            });

            var marker = L.marker([lat, lon], { icon: patientIcon }).addTo(map);    //Ambulance marker on the map


            function getHref(obj)
            {
                console.log(obj.target.id);
            }
 

            navigator.geolocation.watchPosition(w_success, w_error);
            function w_success(pos) {
                marker.setLatLng([pos.coords.latitude, pos.coords.longitude]);
            }
            function w_error(err) {
                //Error to display
            }

            $(document).ready(function(){
            $('#alert').hide();
            $('#check').on('click',function(){
                var type = $('#amb_type').val();
                var dist = $('#amb_district').val();
                var city = $('#ptn_city').val();
                var state = $('#ptn_state').val();

                console.log(type,dist,city,state);
                $.ajax({
                    url:"{{ route('check-availability') }}",
                    type:"GET",
                    data:{'type':type,'dist':dist,'city':city,'state':state},
                    success:function(data){
                        // console.log(data);
                        var rows = data.data;
                        var html = '';
                        if(rows.length>0)
                        {
                            html+='There are '+rows.length+' services currently available';
                            $('#msg-box').html(html);
                            console.log(rows[0]['amb_loc_lat']);

                            map.flyTo([rows[0]['amb_loc_lat'],rows[0]['amb_loc_lng']]);
                        }
                        else
                        {
                            html+='Sorry! No services available in this area';
                            $('#msg-box').html(html);
                        }
                    }
                })
            })
            $('#proceed_addrs').on('click',function(){

                if(!'{{session()->has('user_id')}}')
                {
                    $('#alert').show();
                    $("#proceed_addrs").prop("disabled",true);
                    $("#current_addrs").prop("disabled",true);
                }
                else
                {
                    var type = $('#amb_type').val();
                var dist = $('#amb_district').val();
                var city = $('#ptn_city').val();
                var state = $('#ptn_state').val();
                var zip = $('#ptn_zip').val();

                api_key = "ee2dfca941774c139225977bbddebb90";

                fetch('https://api.opencagedata.com/geocode/v1/json?q='+state+'%2C'+dist+'%2C'+city+'%2C'+zip+'&key='+api_key+'&Limit=1')
                .then(response=>(response.json()))
                .then(result=>{
                    if(result)
                    {
                        let details = result.results[0];
                        console.log(result.results);
                        let loc_txt = details['formatted'];
                        let loc_geometry = details['geometry'];
                        let latitude = loc_geometry['lat'];
                        let longitude = loc_geometry['lng'];
                        console.log(latitude,longitude);
                        window.location.href = "/amb-ptn-home?fmt_ads="+loc_txt+"&lat="+latitude+"&lng="+longitude+"&amb_type="+type+"&city="+city+"&state="+state+"&dist="+dist+"&zip="+zip;
                    }
                    else
                    {
                        alert("Sorry cannot detect location");
                    }
                })
                }

            })
            
            $('#current_addrs').on('click',function(){
                
                if(!'{{session()->has('user_id')}}')
                {
                    $('#alert').show();
                    $("#proceed_addrs").prop("disabled",true);
                    $("#current_addrs").prop("disabled",true);
                }
                else
                {
                    api_key = "ee2dfca941774c139225977bbddebb90";
                    let loc_txt = "";

                    fetch('https://api.opencagedata.com/geocode/v1/json?q='+lat+','+lon+'&key='+api_key)
                    .then(response=>(response.json())).then(result=>{
                        let details = result.results[0];
                        loc_txt = details['formatted'];
                        console.log(loc_txt);
                        var address = loc_txt;
                        window.location.href = "/amb-ptn-home?fmt_ads="+address+"&lat="+lat+"&lng="+lon;
                    })
                }
                
            })
        })
        }

        function error(err) {
            if (err.code === 1) {
                alert("Please allow location access");
            }
        }


    </script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>