<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Contact;
use Core\View\Engine; 

class ContactController
{
    public function __construct(private Contact $contactModel) 
    {
    }

    // --- 1. READ / SEARCH ---
    public function index()
    {
        $searchQuery = $_GET['q'] ?? '';

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

    // --- 2. CREATE (Show Form) ---
    public function create()
    {
        Engine::render('contacts/create', [
            'contact' => [] 
        ]);
    }

    // --- 3. STORE (Process Form) ---
    public function store()
    {
        $data = [
            'name'  => trim($_POST['name'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'phone' => trim($_POST['phone'] ?? ''),
            'tags'  => trim($_POST['tags'] ?? ''),
        ];

        $errors = [];
        if (empty($data['name'])) {
            $errors['name'] = 'Error: Name cannot be empty!';
        }
        if (empty($data['email'])) {
            $errors['email'] = 'Error: Email cannot be empty!';
        }
        if (empty($data['phone'])) {
            $errors['phone'] = 'Error: Phone number cannot be empty!';
        }

        if (!empty($errors)) {
            Engine::render('contacts/create', [
                'contact' => $data,
                'errors'  => $errors
            ]);
            return;
        }

        $this->contactModel->save($data);

        header('Location: /durano-mvc-framework/public/');
        exit;
    }

    // --- 4. EDIT (Show Form) ---
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

    // --- 5. UPDATE (Process Form) ---
    public function update(string $id)
    {
        $data = [
            'name'  => trim($_POST['name'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'phone' => trim($_POST['phone'] ?? ''),
            'tags'  => trim($_POST['tags'] ?? ''),
        ];

        $errors = [];
        if (empty($data['name'])) {
            $errors['name'] = 'Error: Name cannot be empty!';
        }
        if (empty($data['email'])) {
            $errors['email'] = 'Error: Email cannot be empty!';
        }
        if (empty($data['phone'])) {
            $errors['phone'] = 'Error: Phone number cannot be empty!';
        }

        if (!empty($errors)) {
            $data['id'] = $id; 
            
            Engine::render('contacts/edit', [
                'contact' => $data,
                'errors'  => $errors 
            ]);
            return;
        }

        $this->contactModel->update((int)$id, $data);

        header('Location: /durano-mvc-framework/public/');
        exit;
    }

    // --- 6. DELETE ---
    public function delete(string $id)
    {
        $this->contactModel->delete((int)$id);

        header('Location: /durano-mvc-framework/public/');
        exit;
    }
}