<?php 

namespace App\Controllers;

use App\Models\Contact;

class HomeController extends Controller {
    
    public function index(){

        $Contacto = new Contact;
        return $Contacto->query("SELECT * FROM contacts")->get();

        return $this->view('home', [
            'title' => 'Home Title',
            'description'   => 'Home Description'
        ]);
    }
}