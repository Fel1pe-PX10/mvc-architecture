<?php 

namespace App\Controllers;

use App\Models\Contact;

class HomeController extends Controller {
    
    public function index(){

        $Contacto = new Contact;
        return $Contacto->find(2);
        /* return $Contacto->update(6, [
            'name' => 'test11',
            'email' => 'tes11@test.com',
            'phone' => '1234567'
        ]); */

        return $this->view('home', [
            'title' => 'Home Title',
            'description'   => 'Home Description'
        ]);
    }
}