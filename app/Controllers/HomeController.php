<?php 

namespace App\Controllers;

use App\Models\Contact;

class HomeController extends Controller {
    
    public function index(){

        $Contacto = new Contact;
        return $Contacto->delete(5);

        return $this->view('home', [
            'title' => 'Home Title',
            'description'   => 'Home Description'
        ]);
    }
}