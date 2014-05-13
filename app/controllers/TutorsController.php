<?php

class TutorsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function showTutors() {

		$name = Session::get('user');
		//check if the current user is a tutor or not
		if (count(Hiredtutor::where('MUid', '=', $name)->get())) {

			$customerArray1 = Wishlist::where('MUid', '=', $name)->lists('customer');
			$courseIDArray1 = Wishlist::where('MUid', '=', $name)->lists('courseID');
			$timeArray1 	= Wishlist::where('MUid', '=', $name)->lists('time');

			$customerArray2 = Tutor::where('MUid', '=', $name)->lists('customer');
			$courseIDArray2 = Tutor::where('MUid', '=', $name)->lists('courseID');
			$timeArray2 	= Tutor::where('MUid', '=', $name)->lists('time');


	    	$data['confirmedcustomers'] = $customerArray2;

	    	$data['confirmedcourses'] = $courseIDArray2;

	    	$data['confirmedtimes'] = $timeArray2;

	    	$data['wishlistcustomers'] = $customerArray1;

	    	$data['wishlistcourses'] = $courseIDArray1;

	    	$data['wishlisttimes'] = $timeArray1;

	        return View::make('tutors.tutors', $data);
    	} else {

    		return Redirect::to('about');
    	}

    }


    public function postTutors() {

    	// Get all the inputs
        // id is used for login, username is used for validation to return correct error-strings
    	//return Input::all();
    	//return;
        $name = Session::get('user');
    	//pull data into Tutor
    	$action = Input::get("action");
        $customer = Input::get("name");
        $courseID = Input::get("course");
        $time = Input::get("time");
        if ($action == "Delete") {
        	Wishlist::where('MUid', '=', $name)
					->where('customer', '=', $customer)
					->where('courseID', '=', $courseID)
		        	->where('time', '=', $time)
		        	->delete();
        } elseif ($action == "Cancel") {
        	//if the course has already been canceled by the client, the following actions shouldn't be executed at all
        	$checkCourse = Tutor::where('MUid', '=', $name)
		         			    ->where('time', '=', $time)
		         				->get();
		    if (sizeof($checkCourse) != 0) {
	        	$clientcourse = new Clientcourse;
			    $clientcourse->MUid = $customer;
			    $clientcourse->courseID = $courseID;
			    $clientcourse->save();

			    $clienttime = new Clienttime;
			    $clienttime->MUid = $customer;
			    $clienttime->time = $time;
			    $clienttime->save();

			    Tutor::where('MUid', '=', $name)
			         ->where('time', '=', $time)
			         ->delete();
			    $me = $name . "@miamioh.edu";
				//define("me", $me);
				$other = $customer . "@miamioh.edu";
				//define("other", $other);
				Mail::send('emails.auth.test', array('name' => 'Rinella Learning Center'), function($message) use ($me){
					$message->to($me)->subject('Cancel');
				});	
				/*Mail::send('emails.auth.test', array('name' => 'Rinella Learning Center'), function($message) use ($other){
					$message->to($other)->subject('Confirm!');
				});*/
		    } else {
		    	//the course has already been canceled by the client
		    	echo "fail4";
		    }
        } else {
        	//action == "Confirm"
        	//first of all check whether the course exists or not 
        	$checkCourse = Clientcourse::where('MUid', '=', $customer)
	    						   	   ->where('courseID', '=', $courseID)
	    						   	   ->get();

	    	if (sizeof($checkCourse) != 0) {

        		//check time conflict and availability
        		$chosenTimes = Tutor::where('MUid', '=', $name)->lists('time');
	        	if (!in_array($time, $chosenTimes)) {
	    			//no time conflict
	    			
	    				//available
	        		if (sizeof($chosenTimes) < 6) {
			    		$tutor = new Tutor;
						$tutor->MUid = $name;
						$tutor->customer = $customer;
						$tutor->courseID = $courseID;
						$tutor->time = $time;
						$tutor->save();

						Wishlist::where('MUid', '=', $name)
								->where('customer', '=', $customer)
								->where('courseID', '=', $courseID)
			        		  	->where('time', '=', $time)
			        		  	->delete();

			        	Clientcourse::where('MUid', '=', $customer)
			        				->where('courseID', '=', $courseID)
			        				->delete();
			        	Clienttime::where('MUid', '=', $customer)
			        			  ->where('time', '=', $time)
			        			  ->delete();

			        	//make sure the <customer, courseID> instance disppears in the wishlist
			        	Wishlist::where('customer', '=', $customer)
								->where('courseID', '=', $courseID)
			        		  	->delete();
						//send emails to both myself and client
						$me = $name . "@miamioh.edu";
						//define("me", $me);
						$other = $customer . "@miamioh.edu";
						//define("other", $other);

						Mail::send('emails.auth.test', array('name' => 'Rinella Learning Center'), function($message) use ($me) {
							$message->to($me)->subject('Confirm');
						});	
						/*Mail::send('emails.auth.test', array('name' => 'Rinella Learning Center'), function($message) use ($other){
							$message->to($other)->subject('Confirm!');
						});*/
					    echo "ok";
					} else {
						//not available
						echo "fail2";
					}
			    	
	    		} else {
	    			//time conflict
	    			echo "fail1";
	    		}
	    	} else {
	    		echo "fail3";
	    	}
        }
        
    }


}
