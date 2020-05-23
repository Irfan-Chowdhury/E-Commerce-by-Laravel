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
        {{-- @if(Auth::guard('admin')->user()->category == 1) --}}
        @if(Auth::user()->category == 1)
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
        @endif

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
        @if(Auth::user()->coupon == 1)
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
        @endif

        <!-- Poduct -->
        @if(Auth::user()->product == 1)
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
        @endif

        <!-- Blog -->
        @if(Auth::user()->blog == 1)
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
        @endif


        <!-- Order  -->
        @if(Auth::user()->order == 1)
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
        @endif


        <!-- Report -->
        @if(Auth::user()->report == 1)
          <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
              <i class="menu-item-icon icon ion-ios-paper-outline tx-22"></i>
              <span class="menu-item-label">Reports</span>
              <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('today.order') }}" class="nav-link">Today Order</a></li>
            <li class="nav-item"><a href="{{ route('today.delevered') }}" class="nav-link">Today Delevered</a></li>
            <li class="nav-item"><a href="{{ route('this.month') }}" class="nav-link">This Month</a></li>
            <li class="nav-item"><a href="{{ route('search.report') }}" class="nav-link">Search Report</a></li>
          </ul>
        @endif

        <!-- User Role -->
        @if(Auth::user()->role == 1)
          <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
              <i class="menu-item-icon icon ion-ios-paper-outline tx-22"></i>
              <span class="menu-item-label">Sub-Admin Role</span>
              <i class="menu-item-arrow fa fa-angle-down"></i>
            </div>
          </a>
          <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('sub-admin.all') }}" class="nav-link">All Sub-Admin</a></li>
            <li class="nav-item"><a href="{{ route('sub-admin.create') }}" class="nav-link">Create Sub-Admin</a></li>
          </ul>
        @endif

        <!-- Return Order-->
        @if(Auth::user()->return == 1)
          <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
              <i class="menu-item-icon icon ion-ios-paper-outline tx-22"></i>
              <span class="menu-item-label">Return Order</span>
              <i class="menu-item-arrow fa fa-angle-down"></i>
            </div>
          </a>
          <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{route('return.request')}}" class="nav-link">Return Request</a></li>
            <li class="nav-item"><a href="{{route('return.all')}}" class="nav-link">All Return</a></li>
          </ul>
        @endif
        
        @if(Auth::user()->stock == 1)
          <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
              <i class="menu-item-icon icon ion-ios-paper-outline tx-22"></i>
              <span class="menu-item-label">Product Stock</span>
              <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <ul class="sl-menu-sub nav flex-column">
              <li class="nav-item"><a href="{{ route('product.stock') }}" class="nav-link">Stock</a></li>
          </ul>
        @endif

        <!-- Contact Message -->
        @if(Auth::user()->contact == 1)
          <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
              <i class="menu-item-icon icon ion-ios-paper-outline tx-22"></i>
              <span class="menu-item-label">Contact Message</span>
              <i class="menu-item-arrow fa fa-angle-down"></i>
            </div>
          </a>
          <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="#" class="nav-link">New Message</a></li>
            <li class="nav-item"><a href="#" class="nav-link">All Message</a></li>
          </ul>
        @endif
        
        <!-- Product Comment -->
        @if(Auth::user()->comment == 1)
          <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
              <i class="menu-item-icon icon ion-ios-paper-outline tx-22"></i>
              <span class="menu-item-label">Product Comment</span>
              <i class="menu-item-arrow fa fa-angle-down"></i>
            </div>
          </a>
          <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="#" class="nav-link">New Comment</a></li>
            <li class="nav-item"><a href="#" class="nav-link">All Comment</a></li>
          </ul>
        @endif
        
        <!-- Site Setting -->
        @if(Auth::user()->setting == 1)
          <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
              <i class="menu-item-icon icon ion-ios-paper-outline tx-22"></i>
              <span class="menu-item-label">Setting</span>
              <i class="menu-item-arrow fa fa-angle-down"></i>
            </div>
          </a>
          <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('site.setting') }}" class="nav-link">Site Setting</a></li>
          </ul>
        @endif
        
        <!-- Other -->
        @if(Auth::user()->other == 1)
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
        @endif

      </div><!-- sl-sideleft-menu -->

      <br>
    </div><!-- sl-sideleft -->
    
    <!-- ########## END: LEFT PANEL ########## -->
