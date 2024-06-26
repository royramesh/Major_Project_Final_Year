

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


    <!-- css-start -->
    <link rel="stylesheet" href="{{asset('css/Medical Supplies/navbar.css')}}">
    <link rel="stylesheet" href="{{asset('css/Medical Supplies/navLink.css')}}">
    <link rel="stylesheet" href="{{asset('css/Medical Supplies/media.css')}}">
    <link rel="stylesheet" href="{{asset('css/Medical Supplies/body_cont.css')}}">
    <link rel="stylesheet" href="{{asset('css/Medical Supplies/footer_style.css')}}">
    <link rel="stylesheet" href="{{asset('css/Medical Supplies/backimg.css')}}">
    <link rel="stylesheet" href="{{asset('css/Medical Supplies/cont-card.css')}}">
    <link rel="stylesheet" href="{{asset('css/Medical Supplies/Home.css')}}">
    <link rel="stylesheet" href="{{asset('css/Medical Supplies/location_win.css')}}">
    <link rel="stylesheet" href="{{asset('css/Medical Supplies/seondnav.css')}}">
    <link rel="stylesheet" href="{{asset('css/Medical Supplies/see_cart.css')}}">
    <!--css-end -->

/

</head>
<body>
 <!-- header section start -->
 <header class="header">
    <a href="#" class="logo"><i class="fa-solid fa-heart-pulse"></i>medcare</a>
   
    <div class="search-bar" id="srchbar-above">
        <button class="get-location btn" id="get-location-btn" style="width:50px;"><i class="fas fa-map-marker-alt"></i></button>       
        <input type="text" placeholder="Search" name=search_data id="search_data">
       <button class="btn" value="submit" name="search_data_product" onclick="myfunction()"><i class="fa-solid fa-magnifying-glass"></i></button> 
       
    </div>


   
    <nav class="navbar">
        <a class="navlink" href="/Minor Project 5th_Sem/Emergency_Medical_Support_System/HomePage/index.php">Home</a>
            <a class="navlink" href="/Minor Project 5th_Sem/Emergency_Medical_Support_System/HomePage/index.php#services">Services</a>
            <a class="navlink" href="/Minor Project 5th_Sem/Emergency_Medical_Support_System/HomePage/index.php#review">Review</a>
            <a class="navlink" href="/Minor Project 5th_Sem/Emergency_Medical_Support_System/HomePage/index.php#footer">contact Us</a>
    </nav>
    
    
    <div class="user-avatar-container">
        <a href="http://localhost/Minor%20Project%205th_Sem/Emergency_Medical_Support_System/HomePage/profile.php" id="user-avatar"><i class="fa-solid fa-user fa-lg account-avatar"></i></a>
            

        </div>
        <div id="menu-btn" class="fa fa-bars"> </div>



   <div id="cart">
     <a href="{{route('medical_supplies.cart')}}" id="user-cart"><i class="fa badge fa-cart-shopping fa-2xl" value="{{$totalcount}}" style="color:black"></i></a> 
   </div>
</header>

<!-- header section end -->
<div class="search-navbar" id="srchbar-below">
    <div class="search-bar">
        <button class="get-location btn" id="get-location-btn" style="width:50px;"><i class="fas fa-map-marker-alt"></i></button>
        <input type="text" placeholder="Search...">
        <button class="srch-btn btn"><i class="fa-solid fa-magnifying-glass"></i></button>
    </div>
</div>
    
<div class="hero-section">
    <div class="content">  
        <p class="sub-heading">Medical Supplies at your Doorstep</p>
    </div>
</div>

<div class="secondnav">
    <nav class="segmented-navigation">
        <a href="{{route('medical_supplies.index')}}" class="segmented-item active">Medical Supplies</a>
        <a href="{{route('medical_supplies.indexb')}}" class="segmented-item ">Technical Supplies</a>
      </nav>
    </div>

<section class="body-container">
    <div class="contents">

            <!-- Your content goes here | check body_cont.css file for css property-->

     <div class="cards">
        @foreach($medical_supplies_medicals as $medical_supplies_medical)
         <div class='card'>
                <img src="{{asset('pictures/'.$medical_supplies_medical->product_image)}}" >
                <div class='card-details'>
                    <p class='card-name'>{{$medical_supplies_medical->product_name}}</p>
                    <p class='card-address'>..... </p>
                    <p class='card-type'>{{$medical_supplies_medical->product_para}}</p>
                    <p class='card-fare'>{{$medical_supplies_medical->product_rate}}</p>
                    <a href="{{route('medical_supplies.detail',['medical_supplies_medical'=>$medical_supplies_medical])}}"><button class='btn btn-secondary-orange'>Details</button></a>
                </div>
          </div>
        @endforeach
     </div>
      
    </div>


  <!-- Location window popup starts here -->
            
  <div class="location-window" id="loc-win">
                <div class="card popup">
                    <button class="dismiss-btn" id="dismiss">&times</button>
                    <div class="loc-head">
                        <span>Enter an Indian pincode here</span>
                        <div class="loc-option-tab">
                            <input type="number" name="pincode" placeholder="Pincode here" id="zipcode">
                            <button class="btn" id="pin-apply">Apply</button>
                        </div>
                    </div>
                    <div class="loc-head">
                        <span>Allow to access your location</span>
                        <div class="loc-option-tab">
                            <button class="get-location btn" id="det-location"><i class="fa-solid fa-location-crosshairs"></i>Detect my location</button>
                        </div>
                    </div>
                    <div class="loc-head">
                        <div class="loc-option-tab">
                            <label for="" id="location-txt">
                              
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Location window popup ends here -->


<footer>
    <div class="footer-top">
        <a href="#" class="logo"><i class="fa-solid fa-heart-pulse"></i>medcare</a>
        <div class="footer-txt">
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Soluta facilis maxime eius ad id qui quos quod corporis non minus! Lorem, ipsum dolor sit amet consectetur adipisicing elit. Porro, voluptates 
        </div>
    </div>
    <div class="footer-bottom">
        <div class="company-col footer-link-col">
            <h2>Company</h2>
            <ul>
                <li>About Company</li>
                <li>Customer's Speak</li>
                <li>In the News</li>
                <li>Terms and Conditions</li>
                <li>Privacy Policy</li>
                <li>Contact</li>
            </ul>
    </div>
    <div class="shopping-col footer-link-col">
            <h2>Shopping</h2>
            <ul>
                <li>Browse by Manufacturers</li>
                <li>Health Articles</li>
                <li>Offers / Coupons</li>
                <li>FAQs</li>
            </ul>
    </div>
    <div class="link-col footer-link-col">
            <h2>Useful Links</h2>
            <ul>
                <li>Home</li>
                <li>About us</li>
                <li>Services</li>
                <li>Contact us</li>
            </ul>
    </div>
    </div>
</footer>

</div>
</section>

        <!-- Footer bar -->
    <script src="location.js"></script>   
    <script src="common.js"></script>
    <script src="search.js"></script>
    <script>
        
        function myfunction()
        {
            var x=document.getElementById("search_data").value;
            window.location.href = "{{route('medical_supplies.search')}}"+x;
           
        }
    </script>
</body>
</html>