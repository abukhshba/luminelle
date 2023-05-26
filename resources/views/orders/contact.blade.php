@extends('layouts.app')

@section('content')


    <div class="container">
      <h5 class="top-titles-route"><a  href="{{route('home')}}"><span>Home </span></a> 
   
        <span> / </span> <span>Booking</span>
        <span> / </span> <span>Contact</span></h5>

        <div class="thanks">
          <p class="text-success">Thanks for making an order , We are looking forward to seeing you soon </p>
        </div>
        
        <div class="centered-text">
          <p class="p-3 mb-2 bg-warning text-dark">Contact with the management to make the deposit payment with <span class="vodafone-cash"> Vodafone cash</span>
             <img src="{{asset("assets/images/brand/cash.png") }}" height="60px" width="170px"> </p>
        </div>
        


          <div class="whatsapp">
            <a href="https://wa.me/+201013367402">
              
              <button type="button" class="btn btn-success"> <i class="fab fa-whatsapp"></i> WhatsApp {{config('app.whatsapp')}}</button>
            </a>
          </div>

        
        
    </div>
 
         
   
@endsection




