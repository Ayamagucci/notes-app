<?php

use Core\App;
use Core\Validator;

$db = App::resolve('Core\Database');

$currentUserId = 1;

$note = $db->query('SELECT * FROM notes WHERE id=?', [$_POST['id']])->findOrFail();

authorize($note['user_id'] === $currentUserId);

$errors = [];

if (!Validator::string($_POST['body'], 1, 1000)) {
  $errors['body'] = 'A body of 1-1000 characters in length is required.';
}

if (count($errors) /* NOTE: alt to '!empty($errors)' */) {
  view('notes/edit.view.php', [
    'heading' => 'Edit Note',
    'note' => $note,
    'errors' => $errors
  ]);
  die();
}

$db->query('UPDATE notes SET body=:body WHERE id=:id', [
  'id' => $_POST['id'],
  'body' => $_POST['body']
]);

header('location: /notes');
exit();
