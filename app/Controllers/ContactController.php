<?php

namespace App\Controllers;

use App\Models\Contact;

class ContactController extends Controller {

    public function index(){
        $Contact = new Contact;
        $contacts = $Contact->all();
        return $this->view('contacts.index', compact('contacts'));
    }

    public function create(){
        
    }

    public function store(){
        
    }

    public function show(){
        
    }

    public function edit(){
        
    }

    public function update(){
        
    }

    public function destroy(){
        
    }
}