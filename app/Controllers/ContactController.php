<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Contact;
use Core\View\Engine;
use Core\Http\Response;

class ContactController
{
    public function __construct(private Contact $contactModel) 
    {
    }

    public function index()
    {
        $searchQuery = $_GET['q'] ?? ''; //searchbar

        if ($searchQuery !== '') {
            $contacts = $this->contactModel->searchBy('name', $searchQuery);
        } else {
            $contacts = $this->contactModel->all();
        }

        Engine::render('contacts/index', [
            'contacts' => $contacts,
            'searchQuery' => $searchQuery
        ]);
    }

    public function create()
    {
        Engine::render('contacts/create', [
            'contact' => new Contact() 
        ]);
    }

    public function store()
    {
        $contact = new Contact();
        $contact->name  = trim($_POST['name'] ?? '');
        $contact->email = trim($_POST['email'] ?? '');
        $contact->phone = trim($_POST['phone'] ?? '');
        $contact->tags  = trim($_POST['tags'] ?? '');

        $errors = [];
        if (empty($contact->name)) {
            $errors['name'] = 'Error: Name cannot be empty!';
        }
        if (empty($contact->email)) {
            $errors['email'] = 'Error: Email cannot be empty!';
        }
        if (empty($contact->phone)) {
            $errors['phone'] = 'Error: Phone number cannot be empty!';
        }

        if (!empty($errors)) {
            Engine::render('contacts/create', [
                'contact' => $contact,
                'errors'  => $errors
            ]);
            return;
        }

        $contact->db = $this->contactModel->db; 
        $contact->save();

        Response::redirect('/durano-mvc-framework/public/');
    }

    public function edit(string $id)
    {
        $contact = $this->contactModel->find((int)$id);

        if (!$contact) {
            http_response_code(404);
            echo "<h1>404 - Contact Not Found</h1>";
            return;
        }

        Engine::render('contacts/edit', [
            'contact' => $contact
        ]);
    }

    public function update(string $id)
    {
        $contact = $this->contactModel->find((int)$id);
        
        if (!$contact) {
            http_response_code(404);
            echo "<h1>404 - Contact Not Found</h1>";
            return;
        }

        $contact->name  = trim($_POST['name'] ?? '');
        $contact->email = trim($_POST['email'] ?? '');
        $contact->phone = trim($_POST['phone'] ?? '');
        $contact->tags  = trim($_POST['tags'] ?? '');

        $errors = [];
        if (empty($contact->name)) {
            $errors['name'] = 'Error: Name cannot be empty!';
        }
        if (empty($contact->email)) {
            $errors['email'] = 'Error: Email cannot be empty!';
        }
        if (empty($contact->phone)) {
            $errors['phone'] = 'Error: Phone number cannot be empty!';
        }

        if (!empty($errors)) {
            Engine::render('contacts/edit', [
                'contact' => $contact,
                'errors'  => $errors 
            ]);
            return;
        }

        $contact->db = $this->contactModel->db;
        $contact->save();
        Response::redirect('/durano-mvc-framework/public/');
    }

    public function delete(string $id)
    {
        $this->contactModel->delete((int)$id);
        Response::redirect('/durano-mvc-framework/public/');
    }

    public function about()
    {
        return Engine::render('contacts/about');
    }
}

