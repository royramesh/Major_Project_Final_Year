


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
        

    <link rel="stylesheet" href="{{asset('css/hcs_admin.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/useravatar.css')}}"> --}}
    <style>
    

    </style>
    <title>HCS Admin</title>
</head>
<body>
    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span class="lab la-accusoft"></span><span>Index</span></h2>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li>
                <a href="#" class="active" style="text-decoration:none"><span class="las la-igloo"></span>
                    <span>Dashboard</span></a>
                </li>
                <li>
                 <a href="/hcs_emp_admin_ongoing_order" ><span class="las la-shopping-bag"></span>
                    <span>Ongoing Orders</span></a>
                </li>
                <li>
                 <a href="/hcs_emp_admin_all_orders"><span class="las la-shopping-bag"></span>
                    <span>All Orders</span></a>
                </li>
                <li>
                 <a href="/hcs_emp_admin_completed_orders"><span class="las la-shopping-bag"></span>
                    <span>Completed Orders</span></a>
                </li>
                {{--<li>
                    <a href="/Minor Project 5th_Sem/Emergency_Medical_Support_System/admin panel/ambulance Srvc admin/amb_srvc_admin.php" ><span class="las la-ambulance"></span>
                    <span>Ambulance Service</span></a>
                </li>
                <a href="/Minor Project 5th_Sem/Emergency_Medical_Support_System/admin panel/Blood_Bank/adminb.php" ><i class="fa-solid fa-building-columns"></i></span>
                <li>
                    <a href="/Minor Project 5th_Sem/Emergency_Medical_Support_System/admin panel/Blood_Bank/adminb.php"> <span class="las la-landmark"></span>
                    <span>Blood Bannk Service</span></a>
                </li>
                <li>
                    <a href="/Minor Project 5th_Sem/Emergency_Medical_Support_System/admin panel/bed booking admin/bed_booking_admin.php" ><span class="las la-hospital"></span>
                    <span>Bed Booking Service</span></a>
                </li>
                <li>
                    <a href="/Minor Project 5th_Sem/Emergency_Medical_Support_System/admin panel/MedTechSupport/medtech_admin.php" ><span class="las la-hospital"></span>
                    <span>Aya/Nurse/Medical Technician</span></a>
                </li> --}}
              <!--  <li>
                    <a href=""><span class="las la-clipboard-list"></span>
                    <span>Projects</span></a>
                </li>
                <li>
                    <a href=""><span class="las la-shopping-bag"></span>
                    <span>Orders</span></a>
                </li>
                <li>
                    <a href=""><span class="las la-circle"></span>
                    <span>Inventory</span></a>
                </li>
                <li>
                    <a href=""><span class="las la-circle"></span>
                    <span>Accounts</span></a>
                </li>
                <li>
                    <a href=""><span class="las la-clipboard-list"></span>
                    <span>Inventory</span></a>
                </li>  -->
            </ul>
        </div>
    </div>

   <div class="main-content">
    <header>
        <h3>
           <label for="nav-toggle">
             <span class="las la-bars"></span>
           </label>
           Dashboard
        </h3>
        <h3>
        <div class="container-fluid">
    <form class="d-flex">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  </div>
        </h3>
   <div class="user-avatar-container">
    <div class="user-avatar-dropdown">
        <a href="#" id="user-avatar"><i class="fa-solid fa-user fa-lg account-avatar" style='font-size:25px;color:red'></i></a>
        <div class="dropdown-content">
            <a href="/hcs_emp_admin_logout"><i class='fas fa-sign-out-alt'></i>Logout</a>
        </div>
    </div>
    <br>
    @if (session()->has('emp_admin_name'))
       <h6>{{ session()->get('emp_admin_name') }}</h6>
    @else
        @php
            return redirect("/login");
        @endphp
    @endif
</div>
     
</header>
    <main>
        <div class="cards">
            <div class="card-single">
                <div>
                @php
                    $uniqueUserIds = $allorders->where('emp_id', session()->get('emp_admin_id'))->pluck('emp_id')->unique();
                    $uniqueUserCount = $uniqueUserIds->count();
                @endphp

                <h1 style="color: #fff;">{{ $uniqueUserCount }}</h1>
                    <span>Customers</span>
                </div>
                <div>
                    <span class="las la-users" style="color: #fff;"></span>
                </div>
            </div>
            <div class="card-single">
                <div>
                    @php
                        $orderCount = $allorders->where('emp_id', session()->get('emp_admin_id'))->count();
                    @endphp
                    <h1 style="color: #fff;">{{$orderCount}}</h1>
                    <span>All Orders</span>
                </div>
                <div>
                    <span class="las la-shopping-bag" style="color: #fff;"></span>
                </div>
            </div>
            <div class="card-single">
                <div>
                    @php
                        $corderCount = $allorders->where('emp_id', session()->get('emp_admin_id'))->where('order_status', 'Completed')->count();
                    @endphp
                    <h1 style="color: #fff;">{{$corderCount}}</h1>
                    <span>Completed Orders</span>
                </div>
                <div>
                    <span class="las la-shopping-bag" style="color: #fff;"></span>
                </div>
            </div>
            {{-- <div class="card-single">
                <div>
                    <h1 style="color: #fff;"> &#8377 </h1>
                    <span>Income(Current Month)</span>
                </div>
                <div>
                   <span class="lab la-google-wallet" ></span>  
                </div>
            </div> --}}
        </div>
        <br/>
        <br/>
<h2 class="text-center" style="color:#009879;" >Oreder Request</h2>
<table class="table table-striped">
  <thead>
    <tr  style="background-color:#009879;color:white;">
      <th scope="col">User Name</th>
      <th scope="col">Gender</th>
      <th scope="col">Contact Number</th>
      <th scope="col">Email</th>
      <th scope="col">Land Mark</th>
      <th scope="col">Address</th>
      <th scope="col">District</th>
      <th scope="col">State</th>
      <th scope="col">Date & Time</th>
      <th scope="col">Accept</th>
      <th scope="col">Reject</th>
    </tr>
  </thead>
  <tbody>
  @foreach ( $orders as $order )
  @if(session()->get('emp_admin_id')== $order->emp_id)
    <tr>
      <td>{{$order->name}}</td>
      <td>{{$order->gender}}</td>
      <td>{{$order->contact_num}}</td>
      <td>{{$order->order_id}}</td>
      <td>{{$order->land_mark}}</td>
      <td>{{$order->address}}</td>
      <td>{{$order->district}}</td>
      <td>{{$order->state}}</td>
      <td>{{$order->created_at}}</td>
      <td> <a href="{{route('hcs_emp_msg',['order_id' => $order->order_id ])}}"><button type="button" class="btn btn-primary">Accept</button></a></td>
      <td> <a href="{{route('hcs_emp_rej_msg',['order_id' => $order->order_id ])}}"><button type="button" class="btn btn-danger">Reject</button></a><td>
    </tr>
    @endif
    @endforeach
  </tbody>
</table>
    </main>
   </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
     $(document).ready(function() {
        $(".user-avatar-container").click(function() {
            $(".dropdown-content").toggle();
        });
    });
   $(document).ready(function() {
    $('#addBtn').click(function(event) {
        // Prevent the default behavior of the anchor tag
        event.preventDefault();

        // Show alert to the user
        alert("Are you sure you want to perform this action?");

        // Get emp_id from the href attribute of the anchor tag
        var emp_id = $(this).attr('href').split('=')[1];

        // Send Ajax request
        $.ajax({
            url: "{{ route('hcs_emp_verification') }}",
            method: 'GET',
            data: {
                _token: '{{ csrf_token() }}',
                emp_id: emp_id
            },
            success: function(response) {
                // Handle success response

                // Redirect user after successful completion of Ajax request
                window.location.href = "/hcs_order_add";
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(error);
                alert("Error occurred while processing your request.");
            }
        });
    });
     $('#deleteBtn').click(function(event) {
        // Prevent the default behavior of the anchor tag
        event.preventDefault();

        // Show alert to the user
        alert("Are you sure you want to perform this action?");

        // Get emp_id from the href attribute of the anchor tag
        var emp_id = $(this).attr('href').split('=')[1];

        // Send Ajax request
        $.ajax({
            url: "{{ route('hcs_emp_delete') }}",
            method: 'GET',
            data: {
                _token: '{{ csrf_token() }}',
                emp_id: emp_id
            },
            success: function(response) {
                // Handle success response

                // Redirect user after successful completion of Ajax request
                window.location.href = "/hcs_emp_reject";
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(error);
                alert("Error occurred while processing your request.");
            }
        });
    });
});

</script>

</body>
</html>