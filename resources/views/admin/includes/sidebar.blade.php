    <!-- ########## START: LEFT PANEL ########## -->
    <div class="sl-logo"><a href=""><i class="icon ion-android-star-outline"></i> LearnHunter</a></div>
    <div class="sl-sideleft">
      <div class="sl-sideleft-menu">
        <a href="{{ url('admin/home') }}" class="sl-menu-link active">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
            <span class="menu-item-label">Dashboard</span>
          </div>
        </a>

        
        <!-- Category -->
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
            <span class="menu-item-label">Category</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div>
        </a>
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('categories') }}" class="nav-link">Category</a></li>
        </ul>
        
        <!--Sub-Category -->
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
            <span class="menu-item-label">Sub-Category</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div>
        </a>
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{ route('subcategory') }}" class="nav-link">Sub-Category</a></li>
        </ul>

        <!-- Brand -->
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon fab fa-bandcamp tx-20"></i>
              <span class="menu-item-label">Brand</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div>
        </a>
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{ route('brand') }}" class="nav-link">Brand</a></li> 
        </ul>

        <!-- Coupon -->
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
            <span class="menu-item-label">Coupon</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div>
        </a>
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('coupon')}}" class="nav-link">Coupon</a></li>
        </ul>

        <!-- Poduct -->
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
            <span class="menu-item-label">Products</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div>
        </a>
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('product.create')}}" class="nav-link">Add Product</a></li>
          <li class="nav-item"><a href="{{route('product.index')}}" class="nav-link">All Product</a></li>
        </ul>

        <!-- Blog -->
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
            <span class="menu-item-label">Blogs</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div>
        </a>
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('blog.category.index')}}" class="nav-link">Category of Post</a></li>
          <li class="nav-item"><a href="{{ route('blog.post.create') }}" class="nav-link">Add Post</a></li>
          <li class="nav-item"><a href="{{ route('blog.post.index') }}" class="nav-link">All Post</a></li>
        </ul>


        <!-- Order  -->
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-paper-outline tx-22"></i>
            <span class="menu-item-label">Order</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div>
        </a>
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('order.new')}}" class="nav-link">New Order</a></li>
          <li class="nav-item"><a href="{{ route('order.payment.accept.list') }}" class="nav-link">Accept Payments</a></li>
          <li class="nav-item"><a href="{{ route('order.delivery.progress.list') }}" class="nav-link">Progress Delevery</a></li>
          <li class="nav-item"><a href="{{ route('order.delivery.success.list') }}" class="nav-link">Delivery Success</a></li>
          <li class="nav-item"><a href="{{ route('order.payment.cancel.list') }}" class="nav-link">Cancel Orders</a></li>
        </ul>

        <!-- Other -->
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-paper-outline tx-22"></i>
            <span class="menu-item-label">Others</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div>
        </a>
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('newslater')}}" class="nav-link">Newslater</a></li>
          <li class="nav-item"><a href="{{ route('seo') }}" class="nav-link">Seo Settings</a></li>
        </ul>

      </div><!-- sl-sideleft-menu -->

      <br>
    </div><!-- sl-sideleft -->
    
    <!-- ########## END: LEFT PANEL ########## -->
