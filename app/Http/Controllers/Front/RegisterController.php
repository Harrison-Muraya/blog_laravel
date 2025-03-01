<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Str;
use App\Models\Vrm\Setting;
use Illuminate\Http\Request;
use App\Models\Vrm\Notify;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    // PRIVATE VARIABLES
    private $Table = ''; // Table name will be pluralized

    private $ThemePath = ""; //Main Theme Path starting from resources/views/
    private $MainFolder = "logs"; //Main Folder Name (in prural) inside the resources/views/$ThemePath/pages
    private $SubFolder = ""; //Sub Folder Name inside the resources/views/$ThemePath/pages/$MainFolder/
    private $Upload = ""; //Upload Folder Name inside the public/admin/media

    private $ParentRoute = ""; // Parent Route Name Eg. vrm-settings
    private $AllowedFile = null; //Set Default allowed file extension, remember you can pass this upon upload to override default allowed file type. jpg|jpeg|png|doc|docx|

    private $New = ''; // New
    private $Register = 'account-signup/access'; // Add New
    private $Reverify = 'account-verification/reverify'; // Add New
    private $Edit = ''; // Edit
    private $Update = ''; // Update
    private $Delete = ''; // Delete
    private $Action = ''; // Multiple Entry Action

    private $HeaderName = ""; // (Optional) Name

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //

    }

    /**
     * Global Settings {loadSettings}
     * Method is private and not accessible via the web
     * Todo: This method Load all settings from database via the PreLoad Model:: getSettings()
     *
     * @param optional $view_name (string) Page Name (make sure to add $ThemePath/$MainFolder/$SubFolder/$page_name)
     *
     * @return \Illuminate\Http\Response
     */
    private function loadSettings($view_name = '')
    {
        // Load in Controller Settings from passedSettings method
        $passed = $this->passedSettings();

        //openLoad settings
        $settings = Setting::preLoad($view_name, $passed);

        // Return all settings
        return $settings;
    }

    /**
     * Custom Settings {passedSettings}
     * Method is private and not accessible via the web
     * Todo: This method Load all settings for this Controller only
     *
     * @param optional $addtionalData (array) any additional data to be passed on demand
     *
     * @return \Illuminate\Http\Response
     */
    private function passedSettings($addtional_data = [])
    {
        date_default_timezone_set('Africa/Nairobi'); //Time Zone
        $setting['dateTime'] = strtotime(date('Y-m-d, H:i:s')); //Current DateTime

        // Links
        $setting['links'] = (object)[
            'new' => $this->New,
            'register' => $this->Register,
            'reverify' => $this->Reverify,
            'edit' => $this->Edit,
            'update' => $this->Update,
            'delete' => $this->Delete,
            'manage' => $this->Action,
            'route' => $this->ParentRoute,
        ];

        // Other
        $setting['other'] = (object)[
            'headerName' => (!array_key_exists('headerName', $addtional_data)) ? $this->HeaderName : $addtional_data['headerName'],
        ];

        // Header
        $setting['h4_pagetitle'] = '';
        $setting['breadcrumb'] = [];

        // ? Setting
        $setting['get_level'] = [
            'customer' => 'BUYER',
            'writer' => 'WRITER',
            'user' => 'BOTH'
        ];

        // Merge all settings into one array
        $setting = array_merge($setting, $addtional_data);

        // Return all settings
        return $setting;
    }

    /**
     * Page View {show}
     * Method is private and not accessible via the web
     * Todo: This method is the only method that is accessible render the view/page visible via browser.
     *
     * @param  requred $data - (has all the values needed to render the page)
     * @param  optional $layout - (By default the layout is main)
     *
     * @return \Illuminate\Http\Response
     */
    private function show($data, $layout = 'blog')
    {
        // Add Layout
        $data['layoutName'] = $layout;
        //Load Page View
        return view("{$data['theme_dir']}/pages/" . $data['page_name'], $data);
    }

    /**
     * Main {Index}
     * Method is public and accessible via the web
     * Todo: This method is the main settings page.
     *
     * @param  optional  $message - notification message (By default, no message is displayed)
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $message = '')
    {
        // Load View Page Path
        $view = 'register';
        $page = Str::plural($this->MainFolder) . $this->SubFolder .  "/$view";

        // Load Settings
        $data = $this->loadSettings($page);
        $data['other']->view = $view;

        // return to cart
        $data['tocart'] = $request->get('r');

        //Notification
        $notify = Notify::notify();
        $data['notify'] = Notify::$notify($message);

        //Open Page
        return $this->show($data);
    }

    /**
     * Page {open}
     * Method is public and accessible via the web
     * @Todo:
     * This method is used to open a specific view/page (you can pass the view name/full_path and open will call show() method to render the view/page)
     *
     * @param required $view - (the view name/full_path to be rendered)
     * @param  optional $message - notification message (By default, no message is displayed)
     * @param  optional $layout - (By default the layout is main)
     *
     * @return \Illuminate\Http\Response
     */
    public function open($view, $message = '', $layout = 'blog')
    {
        // Load View Page Path
        $page = Str::plural($this->MainFolder) . "/" . $this->SubFolder . $view;

        // Load Settings
        $data = $this->loadSettings($page);
        $data['other']->view = $view;

        //Notification
        $notify = Notify::notify();
        $data['notify'] = Notify::$notify($message);

        //Open Page
        return $this->show($data, $layout);
    }

    /**
     * Todo: This method is used to register customer.
     *
     * @param  \Illuminate\Http\Request  $request - (the request object)
     * @param  required $action - (what option to validate)
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request, $action = '')
    {
       
        // Validate Form Data
        $validator = Validator::make($request->all(), [
            'first_name' => "required|max:10",
            'last_name' => "nullable|max:100",
            'email' => "required|max:200|email|unique:users,email",
            'user_password' => "required|min:5|max:20|confirmed",
        ]);

        // On Validation Failphp
        if ($validator->fails()) {
            session()->flash('notification', 'error');
            Notify::error('Please check the form for errors.');

            // Return Error Message
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        }

        // Validate Form Data
        $validated = $validator->validated();

        // Add User Role
        $insertFrom['name'] = $validated['first_name'] . ' ' . $validated['last_name'];
        $insertFrom['email'] = $validated['email'];
        $insertFrom['password'] = Hash::make($validated['user_password']);
        // usermeta

        // ? Removed from @
        $username = $validated['email'];
        $username = explode('@', $username);
        $username = $username[0];
        // Username
        $insertFrom['username'] = \App\Models\Vrm\Term::username($username);

        // Save Form Data
        $saved = new \App\Models\User();
        $saved->username = $insertFrom['username'];
        $saved->name = $insertFrom['name'];
        $saved->email = $insertFrom['email'];
        $saved->password = $insertFrom['password'];
        $saved->flag = 1;
        $saved->save();
        // dd($saved);

        if ($saved) {

            // ? User Meta
            // foreach ($insertFrom['usermeta'] as $key => $value) {
            //     $usermeta = new \App\Models\Vrm\UserMeta();
            //     $usermeta->user = $saved->id;
            //     $usermeta->key = $key;
            //     $usermeta->value = $value;
            //     $usermeta->save();
            // }

            $message = "Account created successfully.";
            session()->flash('notification', 'success');

            // Return Error Message
            return redirect()->back()->with('message', $message);
        }

        // Notification
        session()->flash('notification', 'error');
        $message = '<strong>Error:</strong>Account was not created, kindly try again.';

        // Open Page
        return $this->index($request, $message); //->with('message', $message);
    }

    /**
     * Todo: Verification
     * Method is public and accessible via the web
     *
     * @param  \Illuminate\Http\Request  $request - (the request object)
     */
    public function verification(Request $request)
    {
        // ? Get Verification Code
        $code = $request->input('v');

        // ? Check if code is valid
        if ($code) {

            // ? Verification Code
            $verification = new \App\Services\Verification();
            $userId = $verification->verifyVerificationCode($code);

            // ? Check if code is valid
            $user = \App\Models\User::where('id', $userId)->first();
            if ($user) {
                // ? Update User
                $user->flag = 1;
                $user->save();

                // ? Notification
                $message = "Account verified successfully. Please login to continue.";
                session()->flash('notification', 'success');


                // To sign in
                $to_login_url = 'account-signin';

                // Check if is in cart
                $_fromcart = $request->get('r');
                if (!is_null($_fromcart) && !empty($_fromcart)) {
                    $to_login_url = $to_login_url . "?r=$_fromcart";
                }

                // ? Redirect
                return redirect("$to_login_url")->with('message', $message);
            }
        }

        // To sign in
        $to_reverify_url = 'account-verification';

        // Check if is in cart
        $_fromcart = $request->get('r');
        if (!is_null($_fromcart) && !empty($_fromcart)) {
            $to_reverify_url = $to_reverify_url . "?r=$_fromcart";
        }

        // ? Notification
        $message = "Account verification failed, might be verification code or token expired. Please try again.";
        session()->flash('notification', 'error');

        // ? Redirect account-verification
        return redirect("$to_reverify_url")->with('message', $message);

        // return $this->open('re-verify', $message, 'log');
    }

    /**
     * Todo: Re-verification
     * Method is public and accessible via the web
     *
     * @param  \Illuminate\Http\Request  $request - (the request object)
     */
    public function reverify(Request $request)
    {
        // Validate Form Data
        $validator = Validator::make($request->all(), [
            'email' => "required|max:200|email",
        ]);

        // On Validation Failphp
        if ($validator->fails()) {
            session()->flash('notification', 'error');
            Notify::error('Please check the form for errors.');

            // Return Error Message
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        }

        // ? Check Email
        $found = \App\Models\User::where('email', $request->email)?->first();
        if ($found) {
            // ? Check Flag
            if ($found->flag == 1) {
                session()->flash('notification', 'warning');

                // ? Message
                $message = 'This account is already active. please login or reset password if you forgot';

                // Return Error Message
                return redirect()->route('account-signin')->withInput($request->input())->with('message', $message);
            }

            // ? Verification Code
            $verification = new \App\Services\Verification();
            $verify = $verification->generateVerificationCode($found->id);
            // ? URL
            $verify_url = url('account-verification') . '?v=' . $verify;

            // ? Maile User
            // if ($found->level == 'customer') {
            //     // ? Mail
            //     Mail::to($found->email)->send(new \App\Mail\RegistrationMail(['verification' => $verify_url]));
            // } else {
            //     Mail::to($found->email)->send(new \App\Mail\RegistrationResearcherMail(['verification' => $verify_url]));
            // }

            session()->flash('notification', 'success');
            $message = "Account verification link sent. Please check your email for verification.";

            // Return Error Message
            return redirect()->route('account-signin')->with('message', $message);
        }

        // ? Message
        $message = "The email entered does not belong to any account. Please register";
        // ? Account Doesnot Exist
        session()->flash('notification', 'error');

        // Return Error Message
        return redirect()->route('account-signup')->with('message', $message);
    }
}
