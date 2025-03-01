<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Vrm\Notify;
use App\Models\Vrm\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{

    // PRIVATE VARIABLES
    private $Table = ''; // Table name will be pluralized

    private $ThemePath = ""; //Main Theme Path starting from resources/views/
    private $MainFolder = "projects"; //Main Folder Name (in prural) inside the resources/views/$ThemePath/pages
    private $SubFolder = "/blogs"; //Sub Folder Name inside the resources/views/$ThemePath/pages/$MainFolder/
    private $Upload = ""; //Upload Folder Name inside the public/admin/media

    private $ParentRoute = ""; // Parent Route Name Eg. vrm-settings
    private $AllowedFile = null; //Set Default allowed file extension, remember you can pass this upon upload to override default allowed file type. jpg|jpeg|png|doc|docx|

    private $New = ''; // New
    private $Save = ''; // Add New
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
            'save' => $this->Save,
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
        $setting['h4_pagetitle'] = 'Dashboard';
        $setting['breadcrumb'] = [];

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
    private function show($data, $layout = 'main')
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
    public function index($message = '')
    {
        // Load View Page Path
        $view = 'blogs';
        $page = Str::plural($this->MainFolder) . $this->SubFolder .  "/$view";

        // Load Settings
        $data = $this->loadSettings($page);
        $data['other']->view = $view;

        //Notification
        $notify = Notify::notify();
        $data['notify'] = Notify::$notify($message);
    
      
        $data['blogs'] = Blog::get();

        // dd($data);
        //Open Page
        return $this->show($data, 'blog');
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
    public function open($view, $message = '', $layout = 'main')
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

    public function showBlog(Request $request, $message = ''){
        // dd($request->all());
        $view = 'blog-content';
        $page = Str::plural($this->MainFolder) . $this->SubFolder . "/$view";

        // Load Settings
        $data = $this->loadSettings($page);
        $data['other']->view = $view;

        //Notification
        $notify = Notify::notify();
        $data['notify'] = Notify::$notify($message);

        $data['blogs'] = Blog::where("id", )->get();

        //Open Page
        return $this->show($data, 'blog');
    }

    public function home($message = ''){
        $view = 'home';
        $page = Str::plural($this->MainFolder) . $this->SubFolder .  "/$view";

        // Load Settings
        $data = $this->loadSettings($page);
        $data['other']->view = $view;

        //Notification
        $notify = Notify::notify();
        $data['notify'] = Notify::$notify($message);

        //Open Page
        return $this->show($data, 'blog');
    }

    public function createBlog($message = ''){
        $view = 'create';
        $page = Str::plural($this->MainFolder) . $this->SubFolder .  "/$view";

        // Load Settings
        $data = $this->loadSettings($page);
        $data['other']->view = $view;

        //Notification
        $notify = Notify::notify();
        $data['notify'] = Notify::$notify($message);

        //Open Page
        return $this->show($data, 'blog');
    }

    public function contactUs($message = ''){
        $view = 'contact-us';
        $page = Str::plural($this->MainFolder) . $this->SubFolder .  "/$view";

        // Load Settings
        $data = $this->loadSettings($page);
        $data['other']->view = $view;

        //Notification
        $notify = Notify::notify();
        $data['notify'] = Notify::$notify($message);

        //Open Page
        return $this->show($data, 'blog');
    }

    public function store(Request $request){
        // Validate Form Data
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'title'=>'',
            'content'=>'',
            'category'=>'',
            // 'path'=>'',         
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
        $insertFrom['title'] = $validated['title'];
        $insertFrom['category'] = $validated['category'];
        // $insertFrom['path'] = $validated['path'];
        $insertFrom['content'] = $validated['content'];
       
        // usermeta

        $saved = new \App\Models\Blog();
        $saved->title = $insertFrom['title'];
        $saved->content = $insertFrom['content'];
        // $saved->path = $insertFrom['path'];
        $saved->category = $insertFrom['category'];
        // $saved->flag = 0;
        $saved->save();

        if($saved){
        
        // Open Page
         return $this->showBlog($request,); //->with('message',
        }

         // Notification
         session()->flash('notification', 'error');
         $message = '<strong>Error:</strong>post was not created, kindly try again.';
 
         // Open Page
         return $this->createBlog($request, $message); //->with('message',
    }
}