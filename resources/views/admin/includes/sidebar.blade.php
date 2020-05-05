    <!-- ########## START: LEFT PANEL ########## -->
    <div class="sl-logo"><a href=""><i class="icon ion-android-star-outline"></i> LearnHunter</a></div>
    <div class="sl-sideleft">
      <div class="sl-sideleft-menu">
        <a href="{{ url('admin/home') }}" class="sl-menu-link active">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
            <span class="menu-item-label">Dashboard</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->

        
        <!-- Category -->
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
            <span class="menu-item-label">Category</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('categories') }}" class="nav-link">Category</a></li>
        </ul>
        
        <!--Sub-Category -->
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
            <span class="menu-item-label">Sub-Category</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{ route('subcategory') }}" class="nav-link">Sub-Category</a></li>
        </ul>

        <!-- Brand -->
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon fab fa-bandcamp tx-20"></i>
              <span class="menu-item-label">Brand</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{ route('brand') }}" class="nav-link">Brand</a></li> 
        </ul>

        <!-- Coupon -->
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
            <span class="menu-item-label">Coupon</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          {{-- <li class="nav-item"><a href="{{ route('coupons') }}" class="nav-link">Coupon</a></li> --}}
          <li class="nav-item"><a href="{{route('coupon')}}" class="nav-link">Coupon</a></li>

        </ul>


        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
            <span class="menu-item-label">Products</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          {{-- <li class="nav-item"><a href="{{ route('add.product') }}" class="nav-link">Add Product</a></li>
          <li class="nav-item"><a href="{{ route('all.product') }}" class="nav-link">All Product</a></li> --}}
          <li class="nav-item"><a href="#" class="nav-link">Add Product</a></li>
          <li class="nav-item"><a href="#" class="nav-link">All Product</a></li>

        </ul>

          <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
            <span class="menu-item-label">Blogs</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          {{-- <li class="nav-item"><a href="{{route('postcats')}}" class="nav-link">PostCategory</a></li>
          <li class="nav-item"><a href="{{ route('add.post') }}" class="nav-link">Add Post</a></li>
          <li class="nav-item"><a href="{{ route('all.post') }}" class="nav-link">All Post</a></li> --}}
          <li class="nav-item"><a href="#" class="nav-link">PostCategory</a></li>
          <li class="nav-item"><a href="#" class="nav-link">Add Post</a></li>
          <li class="nav-item"><a href="#" class="nav-link">All Post</a></li>
        </ul>

        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-paper-outline tx-22"></i>
            <span class="menu-item-label">Others</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          {{-- <li class="nav-item"><a href="{{ route('newslaters') }}" class="nav-link">Newslater</a></li> --}}
          <li class="nav-item"><a href="{{route('newslater')}}" class="nav-link">Newslater</a></li>
          <li class="nav-item"><a href="page-signin.html" class="nav-link">Signin Page</a></li>
          <li class="nav-item"><a href="page-signup.html" class="nav-link">Signup Page</a></li>
          <li class="nav-item"><a href="page-notfound.html" class="nav-link">404 Page Not Found</a></li>
        </ul>
      </div><!-- sl-sideleft-menu -->

      <br>
    </div><!-- sl-sideleft -->
    
    <!-- ########## END: LEFT PANEL ########## -->
