@extends('layouts.app')

@section('content')
<!-- Contact Form -->
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/styles/contact_styles.css')}}">  
    <div class="contact_form">
        <div class="container">
            <div class="row">
    <div class="col-lg-5 offset-lg-1" style="border:1px solid grey; padding: 20px;">
        <div class="contact_form_container">
            <div class="contact_form_title text-center">Sing In</div>

            <form action="{{route('login')}}" method="post">
              @csrf
             <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  placeholder="Enter email">
              </div> 
  
                  <div class="form-group">
                <label for="exampleInputEmail1">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}"  placeholder="Enter password">
            
              </div> 
       
                <div class="contact_form_button">
                    <button type="submit" class="btn btn-info">Login</button>
                </div><br>
                <a href="">I Forgot Password</a>
            </form>
            <br><br><br>
              <button type="submit"  class="btn btn-primary btn-block">Facebook</button>
              <a href="{{ url('/auth/redirect/google') }}"  class="btn btn-danger btn-block">Google</a>
        </div>
    </div>

     <div class="col-lg-5 offset-lg-1" style="border:1px solid grey; padding: 20px;">
        <div class="contact_form_container">
            <div class="contact_form_title text-center">Sign Up</div>

            <form action="{{route('register')}}" method="post">
              @csrf

              <div class="form-group">
                <label>Full Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter name">
              </div> 
               <div class="form-group">
                <label>Email address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter email">
              </div> 

               <div class="form-group">
                <label>Phone</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Enter Number">
              </div>

              <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password"  placeholder="Enter email">
            
              </div> 
              <div class="form-group">
                <label >Confirm Password</label>
                <input type="password" class="form-control" name="password_confirmation" placeholder="Enter Confirm password">
            
              </div> 
                
                <div class="contact_form_button">
                    <button type="submit" class="button contact_submit_button">Sign up</button>
                </div>
            </form>

        </div>
    </div>
</div>
        </div>
        <div class="panel"></div>
    </div>
@endsection
