<?php

namespace App\Http\Controllers\Admin;

use App\Archive;
use App\Category;
use App\FormArchive;
use App\Group;
use App\ImageArchive;
use App\VideoArchive;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    //
    public function getIndex()
    {
        $categories = Category::all();
        $groups = Group::all();

        return view('admin.pages.search.index' ,compact('categories' ,'groups'));
    }

    public function getResult(Request $request)
    {
        $categories = Category::all();
        $groups = Group::all();

        $search = $request->search;
        $type = $request->type;
        $category = $request->category_id;
        $group = $request->group_id;

        if ($category != 0){
            if ($type == 'to'){
                $archives = Archive::where('category_id' , $category)->where('from_to' , 'to')->where('file_number' , 'LIKE' ,'%'.$search.'%')->get();
            }elseif ($type == 'from'){
                $archives = Archive::where('category_id' , $category)->where('from_to' , 'from')->where('file_number' , 'LIKE' ,'%'.$search.'%')->get();
            }elseif ($type == 'images'){
                $archives = ImageArchive::where('category_id' , $category)->where('file_number' , 'LIKE' ,'%'.$search.'%')->get();
            }elseif ($type == 'videos'){
                $archives = VideoArchive::where('category_id' , $category)->where('file_number' , 'LIKE' ,'%'.$search.'%')->get();
            }elseif ($type == 'forms'){
                $archives = FormArchive::where('category_id' , $category)->where('file_number' , 'LIKE' ,'%'.$search.'%')->get();
            }

            return view('admin.pages.search.result' ,compact('archives','type'));
        }

        if ($group != 0){
            if ($type == 'to'){
                $archives = Archive::where('group_id' , $group)->where('from_to' , 'to')->where('file_number' , 'LIKE' ,'%'.$search.'%')->get();
            }elseif ($type == 'from'){
                $archives = Archive::where('group_id' , $group)->where('from_to' , 'from')->where('file_number' , 'LIKE' ,'%'.$search.'%')->get();
            }elseif ($type == 'images'){
                $archives = ImageArchive::where('group_id' , $group)->where('file_number' , 'LIKE' ,'%'.$search.'%')->get();
            }elseif ($type == 'videos'){
                $archives = VideoArchive::where('group_id' , $group)->where('file_number' , 'LIKE' ,'%'.$search.'%')->get();
            }elseif ($type == 'forms'){
                $archives = FormArchive::where('group_id' , $group)->where('file_number' , 'LIKE' ,'%'.$search.'%')->get();
            }

            return view('admin.pages.search.result' ,compact('archives','type'));
        }

        if ($type == 'to'){
            $archives = Archive::where('from_to' , 'to')->where('file_number' , 'LIKE' ,'%'.$search.'%')->get();
        }elseif ($type == 'from'){
            $archives = Archive::where('from_to' , 'from')->where('file_number' , 'LIKE' ,'%'.$search.'%')->get();
        }elseif ($type == 'images'){
            $archives = ImageArchive::where('file_number' , 'LIKE' ,'%'.$search.'%')->get();
        }elseif ($type == 'videos'){
            $archives = VideoArchive::where('file_number' , 'LIKE' ,'%'.$search.'%')->get();
        }elseif ($type == 'forms'){
            $archives = FormArchive::where('file_number' , 'LIKE' ,'%'.$search.'%')->get();
        }

        return view('admin.pages.search.result' ,compact('archives','type'));
    }
}