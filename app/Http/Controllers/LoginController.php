<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\App42\UserService;
use App\App42\App42Response;
use App\App42\App42Exception;     
use App\App42\App42BadParameterException;    
use App\App42\App42NotFoundException;   
use App\App42\App42Log;
use App\App42\App42API; 
use App\Http\Middleware\AppInitialize; 
use Validator;
use Session;

class LoginController extends Controller
{
    private static $userService = null;
    /**
     * Default COnstructor.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        self::$userService = AppInitialize::initUserService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $user = Session::get('user');
        if(isset($user) && !($user->accountLocked)) {
            return redirect()->intended('dashboard');
        } else {
            //Session::flush();
            Session::forget('user');
            return view('admin.login');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Check for the login credentails.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $input = $request->input();
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|min:5',
            'password' => 'required|string|min:5',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)
                         ->withInput();
        }
        try {
            $user = self::$userService->authenticate($input['username'], $input['password']);
            Session::put('user', $user);
            return redirect()->intended('dashboard');
        } catch (\Exception $e) {
            return back()->withErrors(['exception' => $e->getMessage()]);
        }
    }

    /**
     * Logout User.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout() {
        Session::forget('user');
        return redirect()->intended('/login');
    }
}
