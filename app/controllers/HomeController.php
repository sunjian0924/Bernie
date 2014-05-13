<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		
		return View::make('home');
	}
    
    
    public function showAbout() {
        return View::make('about');
    }

    public function showShopping() {
    	$name = Session::get('user');
		//check if the current user is a tutor or not
		if (count(Hiredtutor::where('MUid', '=', $name)->get())) {

			//retrieve clients' MUid information
			$clients = Clientcourse::lists('MUid');
			$clients = array_count_values($clients);
			$clients = array_keys($clients);
			
			
			$courses = array();
			$timestamps = array();
			$times = array();
			while ($MUid = each($clients)) {
				$temp = Clientcourse::where('MUid', '=', $MUid['value'])->lists('courseID');
				array_push($courses, $temp);

				$temp1 = Clientcourse::where('MUid', '=', $MUid['value'])->lists('created_at');
				array_push($timestamps, $temp1);

				$temp2 = Clienttime::where('MUid', '=', $MUid['value'])->lists('time');
				array_push($times, $temp2);
				
			}
			//return $tempArray;
	    	$data['clients'] = $clients;
	    	$data['courses'] = $courses;
	    	$data['timestamps'] = $timestamps;
	    	$data['times'] = $times;
	        return View::make('shopping', $data);
    	} else {

    		return Redirect::to('about');
    	}
    	
    }

    public function postShopping() {
    	
    	$name = Session::get('user');

    	$expertise = Hiredtutor::where('MUid', '=', $name)->lists('expertise');
    	//$chosenTimes = Tutor::where('MUid', '=', $name)->lists('time');

    	$courseID = Input::get('course');
    	$time = Input::get('time');
    	$customer = Input::get('customer');
    	//check whether the course is available at all
    	$checkCourse = Clientcourse::where('MUid', '=', $customer)
	    						   ->where('courseID', '=', $courseID)
	    						   ->get();
	    if (sizeof($checkCourse) != 0) {
		
	    	if (in_array($courseID, $expertise)) {
	    		//competent
	    		//if there already exists an identical instance in the wishlist

	    		$test = Wishlist::where('MUid', '=', $name)
		    					->where('customer', '=', $customer)
		    					->where('courseID', '=', $courseID)
		    					->where('time', '=', $time)
		    					->get();
		    	if (sizeof($test) == 0)
		    	{
		    		$wishlist = new Wishlist;
					$wishlist->MUid = $name;

					$wishlist->customer = $customer;
					$wishlist->courseID = $courseID;

					$wishlist->time = $time;
					$wishlist->save();
					
				    echo "ok";
				} else {
					//already in the wishlist
					echo "fail2";
				}
			    	
	    		
	    	} else {
	    		//not competent
	    		echo "fail1";
	    	}
    	} else {
    		echo "fail3";
    	}
        
    }

}