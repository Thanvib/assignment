<?php
namespace App\Http\Controllers;


use App\Http\Controllers\Controller; 
use App\Reservation;
use Illuminate\Http\Request;


class ReservationController extends Controller 
{

  public function reservation()
  {
    
    return view('reservation');
  }


}