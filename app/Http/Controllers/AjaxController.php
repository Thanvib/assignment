<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Setting;
use App\Reservation;
use Validator;
use DB;


class AjaxController extends Controller {

   public function post(Request $request){

   		$input = $request->all();

        $validator = Validator::make($input, [
        	'number' => 'required',
            'group' => 'required',
            'day' => 'required',
            'tz' => 'required'
        ]);

        if($validator->fails()){

        	$response = array(
	          'status' => 'error',
	          'msg' => 'Please check all fíelds',
      		);
           // return $this->sendError('Validation Error.', $validator->errors()); 
            return response()->json($response, 200);      
        }

        $post = Setting::find(1);

        if (is_null($post)) {
            return response()->json('Not found.');
        }

        $post->n = $input['number'];
        $post->g = $input['group'];
        $post->d = $input['day'];
        $post->tz = $input['tz'];
        $post->save();

      $response = array(
          'status' => 'success',
          'msg' => 'Updated successfully.',
      );

      return response()->json($response, 200); 
   }

   private function checkUserReservation($setting, $requst)
   {

  
      $userExploded = explode(',', $requst->userid);
     
      $requestType = (count($userExploded) > 1) ? 'group' : 'individual';

      if($setting['g'] == 'individual')
      {
          $objRes = new Reservation;
          $listRes =  $objRes->select(DB::raw('group_concat(DISTINCT user_id) as uid'))->whereIn('user_id', $userExploded)->groupBy('user_id')->first();

          $listRes = $listRes->toArray();
          $restrcitedUserId = !empty($listRes) ? array_column($listRes, 'uid') : array();
       
        // print_r($restrcitedUserId); die;
      }
   }

    public function reservationpost(Request $request)
    {
    	$bookingstatus = false;
    	$restrictedId = [];

		  $validator = Validator::make($request->all(), [ 
             'userid' => 'required', 
             'date' => 'required', 
         ]);
		
  		if($validator->fails())
  		{
          	$response = array(
  	          'status' => 'error',
  	          'msg' => $validator->errors(),
        		);
             
          // return $this->sendError('Validation Error.', $validator->errors()); 
          return response()->json($response, 200);      
      }


		//get all setting
		$obj = new Setting;
    $settingList = $obj->first();
   	$settingList = $settingList->toArray();

   	//validation 
    //$validationData = $this->checkUserReservation($settingList, $request);
   	$userId = explode(',',$request->userid);

		$reservationDateTime = strtotime($request->date);

		for($i=0; $i<count($userId); $i++)
		{
			$data[] = [
				'user_id'=> $userId[$i],
				'reservation_timestamp_utc'=>$reservationDateTime
			];
		}

		if(!empty($data))
		{
			$bookingstatus = true;
			Reservation::insert($data);
		}
	
		$response = array(
          'is_booking_restricted' => $bookingstatus,
          'restricted_user_ids' => $restrictedId,
      	);

      return response()->json($response, 200); 
    }
}