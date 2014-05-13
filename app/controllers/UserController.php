<?php



class UserController extends BaseController {

    public function showLogin()
    {
        // Check if we already logged in
        if (Auth::check())
        {
            // Redirect to homepage
            return Redirect::to('/');//->with('success', 'You are already logged in');
        } else {
            // Load the settings from the central config file
            require_once 'config.php';
            // Load the CAS lib
            require_once 'CAS.php';
            // Enable debugging
            phpCAS::setDebug('/tmp/cas');

            // Initialize phpCAS
            phpCAS::client(CAS_VERSION_2_0, $cas_host, $cas_port, $cas_context);

            phpCAS::setNoCasServerValidation();

            // force CAS authentication
            phpCAS::forceAuthentication();


            require 'script_info.php';
            $MUid = phpCAS::getUser();
            $userdata = array(
                'MUid' => $MUid, 
                'password' => "12345"
                );
            //aunthenticate the user
            if (!Auth::attempt($userdata)) {
                $user = new User;
                $user->MUid = $MUid;
                $user->password = Hash::make('12345');
                $user->save();
                //flag this user as a first time user
                Session::put('new', "yes");
            }
            //retrieve user's course information
            
            Session::put('user', $MUid);

            return Redirect::to('/')->with('success', 'You have logged in successfully');
            // for this test, simply print that the authentication was successfull
        }

        // Show the login page
        //return View::make('users/login');
    }
    public function postCourses()
    {
        $user = Session::get('user');
        $courses = Input::get('courses');
        
        foreach($courses as $value) {
            $academics = new Academic;
            $academics->MUid = $user;
            $academics->courseID = $value;
            $academics->save();
        }
        
        Session::forget('new');
        echo "ok";
    }

    public function showProfile() {

        $name = Session::get('user');
        $data["name"] = $name;
        return View::make('users/profile', $data);
    }
    public function getLogout()
    {
        // Log out
        Auth::logout();
        // Load the settings from the central config file
       /* require_once 'config.php';
        // Load the CAS lib
        require_once 'CAS.php';
        // Enable debugging
        phpCAS::setDebug('/tmp/cas');

        // Initialize phpCAS
        phpCAS::client(CAS_VERSION_2_0, $cas_host, $cas_port, $cas_context);
        
        // logout if desired

        phpCAS::logout();*/

        // Redirect to homepage
        return Redirect::to('')->with('success', 'You are logged out');
    }

}

