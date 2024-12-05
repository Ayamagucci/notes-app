<?php

use Core\Database;
use Core\Validator;

$config = require base_path('config.php');
$db = new Database($config['database']);

$note = $_POST['body'];
$errors = [];

if (!Validator::string($_POST['body'], 1, 1000)) {
  $errors['body'] = 'A body of 1-1000 characters in length is required.';
}

if (!empty($errors)) {
  view('notes/create.view.php', [
    'heading' => 'Create Note',
    'note' => $note,
    'errors' => $errors
  ]);
  die();
}

$db->query('INSERT INTO notes(body, user_id) VALUES(:body, :user_id)', [
  'body' => $note,
  'user_id' => 1
]);

header('location: /notes');
exit();
