<?php

use Core\App;

$db = App::resolve('Core\Database');

$currentUserId = 1;

$note = $db->query('SELECT * FROM notes WHERE id=?', [$_GET['id']])->findOrFail();

authorize($note['user_id'] === $currentUserId);

view('notes/show.view.php', [
  'heading' => 'Note',
  'note' => $note
]);
