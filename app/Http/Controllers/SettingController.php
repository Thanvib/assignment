<?php
namespace App\Http\Controllers;


use App\Http\Controllers\Controller; 
use App\Setting;
use Illuminate\Http\Request;


class SettingController extends Controller 
{

  public function setting()
  {
    //$obj = new Setting;

    $data = array(
      'tz' => array(
          'UTC'=>'UTC',
          'Asia/Kolkata'=>'Asia/Kolkata',
          'America/NewYork'=>'America/NewYork'
        ),
       'd' => array(
          'Day'=>'Day',
          'Week'=>'Week',
          'Month'=>'Month'
        ),
       'g' => array(
          'Individual'=>'Individual',
          'Group'=>'Group'
        )

    );

    return view('setting', $data);
  }


}