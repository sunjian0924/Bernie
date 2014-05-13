<?php

class ClientsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function showClients() {
		//return $data = Academic::find('1');
		//$collection = User::all();
		
		$name = Session::get('user');
		//retrieve course information
		$coursesTakingArray = Academic::where('MUid', '=', $name)->lists('courseID');
		$coursesInWaitinglistArray = Clientcourse::where('MUid', '=', $name)->lists('courseID');
		$coursesBeingTutoredArray = Tutor::where('customer', '=', $name)->lists('courseID');

		$coursesInWaitinglistOrBeingTutoredArray = array_merge($coursesInWaitinglistArray, $coursesBeingTutoredArray);
		
		$coursesTakingNotTutoredOrInWaitinglistArray = array_diff($coursesTakingArray, $coursesInWaitinglistOrBeingTutoredArray);

		//retrieve time information
		$timeChosen = Clienttime::where('MUid', '=', $name)->lists('time');

    	$data['coursesAvailable'] = $coursesTakingNotTutoredOrInWaitinglistArray;
    	$data['coursesWaitinglist'] = $coursesInWaitinglistArray;
    	$data['timeChosen'] = $timeChosen;
        return View::make('clients.clients', $data);
    }

    public function postClients() {

    	


        	//valid data
        	//save data 
        	$name = Session::get('user');
        	//delete all the data in Clientcourse and Clienttime first
        	Clientcourse::where('MUid', '=', $name)
        				->delete();
        	Clienttime::where('MUid', '=', $name)
        				->delete();
        	$courses = Input::get('courses');
        	//if the $name $courseID pair already exists in the database, no need to insert
        	foreach($courses as $element) {
	        		$clientcourses = new Clientcourse;
	    			$clientcourses->MUid = $name;
	        		$clientcourses->courseID = $element;
	        		$clientcourses->save();
			}

	        $times = Input::get('times');
	    
	        foreach($times as $element) {
	        	$clienttimes = new Clienttime;
	    		$clienttimes->MUid = $name;
	        	$clienttimes->time = $element;
	        	$clienttimes->save();
			}
			echo "ok";

    }

    public function showRecords() {

		$name = Session::get('user');
		//check if the current user is a tutor or not
		


		$tutorArray = Tutor::where('customer', '=', $name)->lists('MUid');
		$courseIDArray = Tutor::where('customer', '=', $name)->lists('courseID');
		$timeArray 	   = Tutor::where('customer', '=', $name)->lists('time');


	    $data['tutors'] = $tutorArray;

	   	$data['courses'] = $courseIDArray;

	    $data['times'] = $timeArray;

	    return View::make('clients.records', $data);
    	

    }


    public function postRecords() {

    	// Get all the inputs
        // id is used for login, username is used for validation to return correct error-strings

        $name = Session::get('user');
        $tutor = Input::get("name");
    	//pull data into Tutor
    	$action = Input::get("action");
    	if ($action == 'Cancel') {
	        
	        $courseID = Input::get("course");
	        $time = Input::get("time");

	        Tutor::where('MUid', '=', $tutor)
	        	 ->where('time', '=', $time)
	        	 ->delete();
	        //send email
	       	//get email address
	        $me = $name . "@miamioh.edu";
        	//define("me", $me);
	        $other = $tutor . "@miamioh.edu"; 
	        //define("other", $other);
	       

	        /*Mail::send('emails.auth.test', array('name' => 'Rinella Learning Center'), function($message){
				$message->to($me)->subject('Cancel!');
			});*/
			Mail::send('emails.auth.test', array('name' => 'Rinella Learning Center'), function($message) use ($other){
				$message->to($other)->subject('Cancel!');
			});
        } else {
        	//cancel next week
        	//send email
        	$me = $name . "@miamioh.edu";
        	//define("me", $me);
	        $other = $tutor . "@miamioh.edu"; 
	        //define("other", $other);
	       

	        /*Mail::send('emails.auth.test', array('name' => 'Rinella Learning Center'), function($message) use ($me){
				$message->to($me)->subject('Cancel Next Week!');
			});*/
			Mail::send('emails.auth.test', array('name' => 'Rinella Learning Center'), function($message) use ($other) {
				$message->to($other)->subject('Cancel Next Week!');
			});

        }
		
        
    }

}
