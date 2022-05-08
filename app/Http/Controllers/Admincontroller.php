<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class Admincontroller extends Controller
{



    // start get Tags
    public function getTag(){

        return Tag::orderBy('id', 'desc')->get();
        
    }



    //strat add tags
    public function addTag(Request $request){
    //validate
    $this->validate($request,[
        'tagName'=>'required'
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
        'id'=>'required'
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
        'iconImage'=>'required',
        'id'=>'required'
    ]);

   Category::where('id',$request->id)->update([
  'categoryName'=>$request->categoryName,
  'iconImage'=>$request->iconImage]);


  return response()->json(['categoryName'=>$request->categoryName,
  'iconImage'=>$request->iconImage]);
   
    }



}//end class admin
