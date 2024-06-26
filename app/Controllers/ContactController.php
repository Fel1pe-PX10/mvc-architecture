<?php

namespace App\Controllers;

use App\Models\Contact;

class ContactController extends Controller {

    public function index(){
        
        $Contact = new Contact;

        return $Contact->select('email', 'id')
                        ->orderBy('id', 'DESC') 
                        ->get();

        if(isset($_GET['search']))
            $contacts = $Contact->where('name', 'LIKE', '%' . $_GET['search'] . '%')->paginate(2);
        else
            $contacts = $Contact->paginate(2);
        
        return $this->view('contacts.index', compact('contacts'));
    }

    public function create(){
        return $this->view('contacts.create');
    }

    public function store(){
        $post = $_POST;
        $Contact = new Contact;
        $Contact->create($post);

        return $this->redirect('/contacts');
    }

    public function show($id){
        $Contact = new Contact;
        $contact = $Contact->find($id);

        return $this->view('contacts.show', compact('contact'));
    }

    public function edit($id){
        
        $Contact = new Contact;
        $contact = $Contact->find($id);

        return $this->view('contacts.edit', compact('contact'));
    }

    public function update($id){
        $post = $_POST;
        $Contact = new Contact;
        $Contact->update($id, $post);

        return $this->redirect('/contacts/'.$id);
        
    }

    public function destroy($id){
        $Contact = new Contact;
        $Contact->delete($id);
        return $this->redirect('/contacts');
    }
}