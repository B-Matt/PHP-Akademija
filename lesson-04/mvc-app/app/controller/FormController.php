<?php

class FormController
{
    /**
     * Registration page with form
     */
    public function index()
    {
        $view = new View();
        $view->render('form');
    }

    /**
     * Form submit
     */
    public function submit()
    {
        $view = new View();
        session_start();
        if(isset($_POST['submit'])) {    
            // form to txt
            if(isset($_POST['name']) && isset($_POST['mail']) && isset($_POST['smjer']) && 
               isset($_POST['godina']) && isset($_POST['motivation']) && isset($_POST['knowlage']) &&
               isset($_POST['lang']) )
            {
                $data = $_POST['name'] . ',' . $_POST['mail'] . ',' . $_POST['smjer']. ',' . $_POST['godina'] . ',' . $_POST['motivation'] . ',' . $_POST['knowlage'] . ',' . $_POST['lang'] . PHP_EOL;
                $file = file_put_contents('inputs.txt', $data, FILE_APPEND);
                $_SESSION['is_sent'] = true;   
            }
            
            // file upload
            $targetFile = 'uploads/' . basename($_FILES["primjer"]["name"]);

            if($_FILES['primjer']['size'] > 5000000) { // 5MB in bytes
                $view->render('form', [
                    'message' => 'Uneseni fajl je prevelik (veci od 5MB)!'
                ]);
            }
            
            $fname          = basename($_FILES["primjer"]["name"]);
            $rawBaseName    = pathinfo($fname, PATHINFO_FILENAME);
            $extension      = pathinfo($fname, PATHINFO_EXTENSION);
            $sameFilesCntr  = 0;
            
            /*while(file_exits('uploads/' . $fname)) {
                $fname = $rawBaseName . $counter . '.' . $extension;
                $sameFilesCntr++;
            }*/
            
            if(!move_uploaded_file($_FILES["primjer"]["tmp_name"], $targetFile)) {
                $view->render('form', [
                    'message' => 'Doslo je do greske pri uploadu fajla! =('
                ]);
            } else {
                header('Location: thankyou');
            }
        }
        
        if(isset($_SESSION['is_sent']) && $_SESSION['is_sent'] == true) {
            $view->render('form', [
                'message' => 'Vec ste se prijavili!'
            ]);
        }
    }

    /**
     * Thank you page
     */
    public function thankyou()
    {
        $view = new View();
         $view->render('form', [
            'message' => 'Hvala Vam što ste se prijavili! =)'
        ]);
    }
    
    /**
     * Admin submit
     */
    public function admin()
    {
        $view = new View();
        $view->render('admin');
    }
}