<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
       // return 'INDEX from new controller named pagescontroller.php';
       $title = 'Welcome To Laravel!';
       //return view('Pages.index', compact('title'));
       return view('Pages.index')->with('title', $title);
    }

    public function about(){
       $title = 'About';
        return view('Pages.about')->with('title',$title);
     }
    
     public function services(){
        $data = array(
           'title' => 'services',
           'services' => ['webdesign','seo','programming']
        );
        return view('Pages.services')->with($data);  
     }
}
