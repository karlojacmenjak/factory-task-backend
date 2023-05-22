<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meals;
use \stdClass;



class MealsResponseController extends Controller
{
    public function page_determine($page, $per_page){
        $calc_page = 1;
        $calc_per_page = 5;
        if(!is_null($page) and is_numeric($page)){
            $calc_page = intval($page);
        }
        if(!is_null($per_page) and is_numeric($per_page)){
            $calc_per_page = intval($per_page);
        }
        $start = max(($calc_page-1) * $calc_per_page, 0);
        return [$start, $start + $calc_per_page, $calc_page, $calc_per_page];
    }

    public function with_determine($with_string)
    {
        $keyword_array = ['category', 'tags', 'ingredients'];
        $return_array = [];
        if(is_null($with_string)) return $return_array;
        
        if(is_string($with_string))
        {
            foreach($keyword_array as $keyword){
                if(str_contains($with_string, $keyword)){
                    array_push($return_array, $keyword);
                }
            }
            
        }
        return $return_array;
    }
      
    public function respond(Request $request){
        $jsonObject = new stdClass();
        $meta = new stdClass();
        $data = new stdClass();


        $page_range = $this->page_determine($request->page,$request->per_page);
        $with_params = $this->with_determine($request->with);
        $meta->currentPage = $page_range[2];
        $meta->itemsPerPage = $page_range[3];
        
        

        $meals = Meals::all();
        $meta->totalItems = $meals->count();
        $meta->totalPages = ceil($meals->count()/$page_range[3]);
        $meal_range = $meals->whereBetween('id', [$page_range[0],$page_range[1]]);
        //$meals = Meals::all();


        $dataArray = array();
        foreach ($meal_range as $meal) {
            $mealData = new stdClass();
            $mealData->id = $meal->id;
            $mealData->title = $meal->title;
            $mealData->description = $meal->description;
            $mealData->status = $meal->status;
            if(in_array('ingredients', $with_params))$mealData->ingredients = $meal->ingredients;
            if(in_array('category', $with_params))$mealData->category = $meal->category;
            if(in_array('tags', $with_params))$mealData->tags = $meal->tags;
            //$title = $meal->getAttributes();
            array_push($dataArray, $mealData);
        }
        $jsonObject->meta = $meta;
        $jsonObject->data = $dataArray;
        $jsonObject->links = "Not implemented";
        return $jsonObject;
        //return [$meal->ingredients, $meal->tags, $meal->category];
         
    }        
}
