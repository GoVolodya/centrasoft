<?php
/**
 * This is AuthController and it holds some logic for login, register, profile, edit pages.
 */

namespace app\controllers;
use app\core\Application;
use app\core\Controller;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\Student;
use app\models\LoginForm;
use app\models\User;

class AuthController extends Controller
{
    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile', 'edit', 'delete']));
    }

    /**
     * Methods for AuthController class.
     */


    public function login(Request $request, Response $response)
    {
        $loginForm = new LoginForm();
        if($request->isPost()){
            $loginForm->loadData($request->getBody());
            if($loginForm->validate() and $loginForm->login()){
                $response->redirect('/');
                return;
            }
        }
        $this->setLayout('main');
        return $this->render('login', [
            'model' => $loginForm,
        ]);
    }


    public function register(Request $request)
    {
        $user = new User();
        if($request->isPost()){
            $user->loadData($request->getBody());
            if($user->validate() and $user->save()){
                Application::$app->session->setFlash('success', 'Tnx for registering');
                Application::$app->response->redirect('/');
                exit;
            }
            return $this->render('register', [
                'model' => $user,
            ]);
        }
        return $this->render('register', [
            'model' => $user,
        ]);
    }

    /**
     * @param Request $request
     * @param Response $response
     */
    public function logout(Request $request, Response $response){
        Application::$app->logout();
        $response->redirect('/');
    }


    public function profile()
    {
        $params = Student::findAll();
        return $this->render('profile', $params);
    }


    public function edit(Request $request, Response $response)
    {
        $id = $request->getId();
        $student = Student::findOne(['id' => $id]);
        if($request->isPost()){
            $params = $request->getBody();
            if($student->edit($params, $id)){
                Application::$app->session->setFlash('success', 'Edited successfully');
                Application::$app->response->redirect('/');
                exit;
            }
            return $this->render('student', [
                'model' => $student,
            ]);
        }
        return $this->render('student', [
            'model' => $student,
        ]);
    }

    /**
     * @param Request $request
     * @param Response $response
     */
    public function delete(Request $request, Response $response){
        $id = $request->getId();
        $student = Student::findOne(['id' => $id]);
        if($request->isGet()){
            if($student->delete($id)){
                Application::$app->session->setFlash('success', 'Student deleted');
                Application::$app->response->redirect('/');
                exit;
            }
        }
        return Application::$app->response->redirect('/');
    }
}