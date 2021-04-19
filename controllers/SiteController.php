<?php
/**
 * This is SiteController and it holds some logic for home page and students page.
 */

namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\Student;

class SiteController extends Controller
{
    /**
     * Methods for SiteController class.
     */


    public function home()
    {
        $params = Student::findAll();
        return $this->render('home', $params);
    }


    public function student(Request $request, Response $response)
    {
        $student = new Student();
        if($request->isPost()){
            $student->loadData($request->getBody());
            if($student->validate() and $student->send()){
                Application::$app->session->setFlash('success', 'Thanks for choosing us');
                return $response->redirect('/student');
            }
        }
        return $this->render('student', [
            'model' => $student
        ]);
    }
}