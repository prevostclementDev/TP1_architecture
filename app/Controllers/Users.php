<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\User;
use App\Libraries\ResponseFormat;
use App\Models\UsersModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\HTTP\ResponseInterface;

class Users extends BaseController
{

    use ResponseTrait;
    use ResponseFormat;

    public function get(int $id): ResponseInterface
    {
        $userModel = new UsersModel();
        $user = $userModel->find($id);

        $userProfile = $user->getLinkProfile();

        return $this->respond(
            $this->addData($user,'user')->addData($userProfile,'profile')->r()
            ,200);
    }

    public function create(): ResponseInterface
    {

        $post = get_object_vars($this->request->getJSON());

        $UsersModel = new UsersModel();
        $userEntity = new User();
        $userEntity->fill($post)->setProfileId();

        try {
            $UsersModel->save($userEntity);
        } catch (DatabaseException|\ReflectionException $e) {
            return $this->respond(
                $this->setError(500,$e->getMessage())->r()
                ,500);
        }

        return $this->respond($this->setCode(201)->r(),201);
    }

    public function delete(int $id): ResponseInterface
    {
        $userModel = new UsersModel();
        $userModel->delete($id);

        return $this->respond($this->r(),200);
    }

    public function update(int $id): ResponseInterface
    {
        $post = get_object_vars($this->request->getJSON());

        $UsersModel = new UsersModel();
        $user = $UsersModel->find($id);

        $user->fill($post)->setProfileId();

        try {
            $UsersModel->save($user);
        } catch (DatabaseException $e) {
            return $this->respond(
                $this->setError(500,$e->getMessage())->r()
                ,500);
        }

        return $this->respond($this->setCode(200 )->r(),200 );
    }

}
