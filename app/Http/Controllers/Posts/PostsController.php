<?php

namespace App\Http\Controllers\Posts;

use Exception;
use App\Http\Enums\Codes;
use Illuminate\Http\Request;
use App\Http\Controllers\MyController;
use App\Models\Posts\PostsModel;

class PostsController extends MyController{

    private $model;
    private $validations;

    public function __construct(){
        parent::__construct();
        $this->initValidations();
        $this->model = new PostsModel();
    }

    /**
     * @author Vanessa Bernal
     * @version 1.0.0
     * @internal Metodo usado para inicializar la validacion de campos en el controlador.
     */
    public function initValidations(){
        $this->validations = [
            'id'                 => 'prohibited',
            'post_title'         => 'required|string|max:255',
            'post_description'   => 'required|string|max:255',
            'post_image'         => 'required|string|max:255',
            'author_id'          => 'required|integer',
            'post_delete'        => 'prohibited',
            'created_at'         => 'prohibited',
            'updated_at'         => 'prohibited',
        ];
    }

    /**
     * @author Vanessa Bernal
     * @version 1.0.0
     * @internal Metodo usado para consultar datos en un listado
     */
    public function index() {
        try{
            $result     = $this->model->get();

            return $this->returnData($result,Codes::ERROR_NOT_FOUN_DATA->getMessage());
            
        }catch(Exception $e){
            $this->showException($e);
            return $this->returnError(Codes::ERROR_OCURRED->getMessage());
        }
    }

    /**
     * @author Vanessa Bernal
     * @version 1.0.0
     * @internal Metodo usado para consultar datos especificos
     * @param $id - Id del author a consultar
     */
    public function show($id) {
        try{
            $result     = $this->model->getById($id);
            return $this->returnData($result,Codes::ERROR_NOT_FOUN_DATA->getMessage());
        } catch (Exception $e){
            $this->showException($e);
            return $this->returnError(Codes::ERROR_OCURRED->getMessage());
        }
    }

    /**
     * @author Vanessa Bernal
     * @version 1.0.0
     * @internal Metodo usado para almacenar los datos
     * @param Request $request - Datos enviados por el cliente
     */
    public function store(Request $request){
        try {
            // validacion de request
            $validator = $this->validateRequest($request,$this->validations);

            if ($validator->fails()) {
                return $this->returnErrorFields($validator->errors());
            }

            $objData = json_decode($request->getContent());
        
            $data = [
                "post_title"        => $objData->post_title,
                "post_description"  => $objData->post_description,
                "author_id"         => $objData->author_id,
                "post_image"        => $objData->post_image
            ];
            // insert data
            $result = $this->model->insertData($data);

            return $this->returnCreated($result, Codes::SUCCESS_CREATE->getMessage());
        } catch (Exception $e) {
            $this->showException($e);
            return $this->returnError(Codes::ERROR_OCURRED->getMessage());
        }
    }

    /**
     * @author Vanessa Bernal
     * @version 2.0.0
     * @internal Metodo usado para actualizar datos en DB.
     * @param Request $request - Datos enviados por el cliente
     * @param int id - id del registro a modificar
     */
    public function update(Request $request, $id){
        try {
            // validacion de request
            $validator = $this->validateRequest($request,$this->validations);
            if ($validator->fails()) {
                return $this->returnErrorFields($validator->errors());
            }
            $objData    = json_decode($request->getContent());

            $data = [
                "post_title"        => $objData->post_title,
                "post_description"  => $objData->post_description,
                "author_id"         => $objData->author_id,
                "post_image"        => $objData->post_image
            ];

            $this->model->updateData($data, $id);

            return $this->returnOk(Codes::SUCCESS_UPDATE->getMessage()); // Actualizado exitosamente
        } catch (Exception $e) {
            return $this->returnError(Codes::ERROR_OCURRED->getMessage()); // Se produjo un error
        }
    }


    /**
     * @author Vanessa Bernal
     * @version 1.0.0
     * @internal Metodo usado para eliminar dato en DB.
     * @param int id - id del registro a eliminar
     */
    public function destroy($id){
        try{
            $this->model->deleteById($id);
            return $this->returnOk(Codes::SUCCESS_DELETED->getMessage());
        }catch(Exception $e){
            return $this->returnError(Codes::ERROR_OCURRED->getMessage()); // Se produjo un error
        }
    }


}

