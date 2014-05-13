<?php

class AdminsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	
	public function showAdmins()
	{
		$name = Session::get('user');
		//check if the current user is a tutor or not
		if (count(Admin::where('MUid', '=', $name)->get())) {

			//retrieve all the hired tutors' information
			$tutorMUidArray = Hiredtutor::lists('MUid');
			$tutorExpertiseArray = Hiredtutor::lists('expertise');

			$data['tutorMUid'] = $tutorMUidArray;
			$data['tutorExpertise'] = $tutorExpertiseArray;

	        return View::make('admins.admins', $data);
    	} else {

    		return Redirect::to('/');
    	}
        
	}

	public function postAdmins()
	{
		
		//for logging's sake
		$name = Session::get('user');
		$action = Input::get('action');

		if ($action == "Add") {
			$MUid = Input::get('MUid');
			$expertise = Input::get('expertise');
			$hiredtutors = new Hiredtutor;
	    		$hiredtutors->MUid = $MUid;
	        	$hiredtutors->expertise = $expertise;
	        	$hiredtutors->save();
	        echo "ok";
		} else {
			//update(delete)
			$delete = Input::get('Delete');
			//retrieve all the hired tutors' information
			$tutorMUidArray = Hiredtutor::lists('MUid');
			$tutorExpertiseArray = Hiredtutor::lists('expertise');
			foreach ($delete as $index) {
				Hiredtutor::where('MUid', '=', $tutorMUidArray[$index])
						  ->where('expertise', '=', $tutorExpertiseArray[$index])
        				  ->delete();
			}
			echo "ok";

		}
	}
	

}
