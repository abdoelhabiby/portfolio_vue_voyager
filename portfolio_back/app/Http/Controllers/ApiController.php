<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
   use ApiResponseTrait;

    protected $module_name;
    protected $model;

    public function index($module_name)
    {
        try {

            $this->setModuleName($module_name);
            $check_model = $this->initModule();


            if ($check_model === false) {
                return $this->notFound();
            }

            $index = $this->model->paginate(6);

            return $this->apiResponse($index, true);
        } catch (\Exception $e) {
            return $this->returnErrorException($e);
        }
    }
//-----------------------------------------------------------
    public function byId($module_name, $id)
    {
        try {

            $this->setModuleName($module_name);

            $check_model = $this->initModule();

            if ($check_model === false) {
                return $this->notFound();
            }

            $index = $this->model->find($id);

            if ($index) {

                return $this->apiResponse($index, true);
            }


            return $this->notFound();
        } catch (\Exception $e) {
            return $this->returnErrorException($e);
        }
    }
//-----------------------------------------------------------

    protected function setModuleName($module_name)
    {
        $this->module_name = $module_name;
    }
//-----------------------------------------------------------
    protected function initModule()
    {
        $module = Str::singular($this->module_name);
        $module = Str::lower($module);
        $module = Str::camel($module);
        $module = Str::ucfirst($module);

        if (in_array($module, $this->exceptModule())) {
            return false;
        }

        $module = "App\\" . $module;

        try {
            $this->model = new $module;
        } catch (\Throwable $th) {

            return false;
        }
    }

//-----------------------------------------------------------
    public function exceptModule()
    {
        return [
            "Contact"
        ];
    }
//-----------------------------------------------------------

    public function contactStore(Request $request)
    {



        try {
            $rules = [
                "name" => "required|string|min:2|max:60",
                "email" => "required|email|max:60",
                "mobile" => "required|string|min:5|max:15",
                "message" => "required|string|min:5|max:400",
            ];

            $validator =  Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return $this->apiResponse($validator->errors(), false, 'error');
            }

            Contact::create($validator->validated());

            return $this->apiResponse([], true, 'succes add your message we will contact with you neear');


        } catch (\Exception $e) {
            return $this->returnErrorException($e);
        }



    }
}
