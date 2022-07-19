<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
//use App\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Admincontroller extends Controller
{


    public function index(Request $request)
    {

     //return $request->path().'<br>'.Auth::check();
        // first check if you are loggedin and admin user ...
        //return Auth::check();

        if (!Auth::check() && $request->path() != 'login') {
            return redirect('/login');
        }
        if (Auth::check()&&$request->path() == 'login') {
            return redirect('/');
        }


        if (Auth::check()) {

            return view('welcome');
        }
    //     // // you are already logged in... so check for if you are an admin user..
     $user = Auth::User();
        if (Auth::check()&&$user->userType == 'user') {
            return redirect('/login');
        }
       

       // return $this->checkForPermission($user, $request);
    }

    // public function checkForPermission($user, $request)
    // {
    //     $permission = json_decode($user->role->permission);
    //     $hasPermission = false;
    //     if (!$permission) {
    //         return view('welcome');
    //     }

    //     foreach ($permission as $p) {
    //         if ($p->name == $request->path()) {
    //             if ($p->read) {
    //                 $hasPermission = true;
    //             }
    //         }
    //     }
    //     if ($hasPermission) {
    //         return view('welcome');
    //     }

    //     return view('welcome');
    //     return view('notfound');
    // }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    



    // start get Tags
    public function getTag(){

        return Tag::orderBy('id', 'desc')->get();
        
    }



    //strat add tags
    public function addTag(Request $request){
    //validate
    $this->validate($request,[
        'tagName'=>'required',
        'tagName'=>'min:2',
        'tagName'=>'max:30',

    ]);

    return Tag::create([

        'tagName'=>$request->tagName
    ]);
    
    }
//strat edit tags
public function editTag(Request $request){
    //validate
    $this->validate($request,[
        'tagName'=>'required',
        'id'=>'required',
        'tagName'=>'min:2',
        'tagName'=>'max:30',
    ]);

   Tag::where('id',$request->id)->update(['tagName'=>$request->tagName]);


  return response()->json(['tagName'=>$request->tagName]);
   
    }



    // start delete tags
    public function deleteTag(Request $request)
    {
        // validate request
        $this->validate($request, [
            'id'=>'required'
        ]);
        return Tag::where('id', $request->id)->delete();
    }



//==============================category==========================================


    //start upload file

    public function upload(Request $request){
        $this->validate($request, [
            'file' => 'required|mimes:jpeg,jpg,png',
        ]);
        $picName = time() . '.' . $request->file->extension();
        $request->file->move(public_path('uploads'), $picName);
        return $picName;
    }
    
    //delete image from file
    public function deleteImage(Request $request)
    {
        $fileName = $request->imageName;
      $this->deleteFileFromServer($fileName, false);
      

        return 'done';
       
        
    }
    public function deleteFileFromServer($fileName, $hasFullPath = false)
    {
        if (!$hasFullPath) {
            $filePath = public_path() . $fileName;
        }
        if (file_exists($filePath)) {
            @unlink($filePath);
        }
        return;
    }


    // start get tags
    public function getCategory(){

        return Category::orderBy('id', 'desc')->get();
        
    }


    //strat add category
    public function addCategory(Request $request){
        //validate
        $this->validate($request,[
            'categoryName'=>'required',
            'categoryName'=>'min:2',
            'categoryName'=>'max:30',
            'iconImage'=>'required'
        ]);
    
        return Category::create([
    
            'categoryName'=>$request->categoryName,
            'iconImage'=>$request->iconImage
        ]);
        
        }




    // start delete tags
    public function deleteCategory(Request $request)
    {
        // validate request
        $this->validate($request, [
            'id'=>'required'
        ]);

        $fileName =  public_path() . $request->iconImage;
       
        if (file_exists($fileName)) {
            @unlink($fileName);
            return Category::where('id', $request->id)->delete();
        }
       
    }

//strat edit tags
public function editCategory(Request $request){
    //validate
    $this->validate($request,[
        'categoryName'=>'required',
        'categoryName'=>'min:2',
        'categoryName'=>'max:30',
        'iconImage'=>'required',
        'id'=>'required'
    ]);

   Category::where('id',$request->id)->update([
  'categoryName'=>$request->categoryName,
  'iconImage'=>$request->iconImage]);


  return response()->json(['categoryName'=>$request->categoryName,
  'iconImage'=>$request->iconImage]);
   
    }




    //admin users 
    public function createUser(Request $request)
    {
        // validate request
        $this->validate($request, [
            'fullName' => 'required',
            'email' => 'bail|required|email|unique:users',
            'password' => 'bail|required|min:6',
            'role_id' => 'required',
        ]);
        $password = bcrypt($request->password);
        $user = User::create([
            'fullName' => $request->fullName,
            'email' => $request->email,
            'password' => $password,
            'role_id' => $request->role_id,
        ]);
        return $user;
    }
    public function editUser(Request $request)
    {
        // validate request
        $this->validate($request, [
            'fullName' => 'required',
            'email' => "bail|required|email|unique:users,email,$request->id",
            'password' => 'min:6',
           
        ]);
        $data = [
            'fullName' => $request->fullName,
            'email' => $request->email,
            'userType' => $request->userType,
        ];
        if ($request->password) {
            $password = bcrypt($request->password);
            $data['password'] = $password;
        }
        $user = User::where('id', $request->id)->update($data);
        return $user;
    }

    public function getUsers()
    {
        return User::get();
    }


    public function adminLogin(Request $request)
    {

        // // validate request
        $this->validate($request, [
            'email' => 'bail|required|email',
            'password' => 'bail|required|min:6',
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            // if ($user->role->isAdmin == 0) {
            //     Auth::logout();
            //     return response()->json([
            //         'msg' => 'Incorrect login details',
            //     ], 401);
            // }
           
            return response()->json([
                'msg' => 'You are logged in',
                'user' => $user,
            ]);
        } else {
            return response()->json([
                'msg' => 'Incorrect login details',
            ], 401);
        }
    }

}//end class admin
