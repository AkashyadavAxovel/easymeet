<?php

namespace App\Http\Controllers;

use App\App42\UserService;
use App\App42\App42Response;
use App\App42\App42Exception;     
use App\App42\App42BadParameterException;    
use App\App42\App42NotFoundException;   
use App\App42\App42Log;
use App\App42\App42API; 
use App\Http\Middleware\AppInitialize; 
use App\App42\OrderByType;    
use App\App42\Query;    
use App\App42\QueryBuilder;    
use App\App42\StorageService;    
use App\App42\JSONObject; 
use Validator;
use Session;

use Illuminate\Http\Request;

class UserController extends Controller
{
    private static $userService = null;
    private static $storageService = null;
    private static $collectionName = null;
    /**
     * Default COnstructor.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        self::$userService = AppInitialize::initUserService();
        self::$storageService = App42API::buildStorageService();  
        self::$collectionName = "User";
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
            try {
                $storage = self::$storageService->findAllDocuments(env('APP42_DBNAME'),self::$collectionName);
                $jsonDocList = $storage->getJsonDocList();
                $pageTitle = 'Users- Admin';
                return view('admin.users.index', compact("pageTitle", "jsonDocList"));
            } catch (\Exception $e) {
                return back()->withErrors(['warning' => $e->getMessage()]);
            }
        } else {
            Session::forget('user');
            return redirect()->intended('login');
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
        try {
            $resp = self::$storageService->deleteDocumentById(env('APP42_DBNAME'),self::$collectionName,$id);   
            if ($resp->isResponseSuccess()) {
                $response = array(
                    'status' => 'success',
                    'message' => ' User deleted  successfully',
                );
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => ' User can not be deleted.Please try again',
                );
            }
        } catch (\Exception $e) {
            $response = array(
                'status' => 'warning',
                'message' => ' Server Error. Please try after sometime!',
            );
        } finally {
            return json_encode($response);
        }
    }

    /**
     * Block/Unblock a specified resources
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function block($id)
    {
        try {
            $storage = self::$storageService->findDocumentById(env('APP42_DBNAME'),self::$collectionName,$id);   
            $jsonDocList = $storage->getJsonDocList();  
            $resp = json_decode(explode(" : ", $jsonDocList[0]->toString())[1]);
            if ( count($jsonDocList) > 0 ) {
                $keys = new JSONObject();  
                $keys->put("is_blocked",!$resp->is_blocked); 
                $storage= self::$storageService->addOrUpdateKeys(env('APP42_DBNAME'), self::$collectionName, $id, $keys);
                $jsonDocList = $storage->getJsonDocList();  
                $resp = json_decode(explode(" : ", $jsonDocList[0]->toString())[1]);
                if ($resp->is_blocked) {
                    return redirect('users')->with('success', 'User blocked successfully');
                } else {
                    return redirect('users')->with('success', 'User unblocked successfully');
                }
            } else {
                return redirect('users')->with('warning', 'Invalid user id!');
            }
        } catch (\Exception $e) {
            return back()->withErrors(['warning' => $e->getMessage()]);
        }
    }
}
