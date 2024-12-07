<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class); // static 'class' prop => full namespaced path

$currentUserId = 1;

$note = $db->query('SELECT * FROM notes WHERE id=?', [$_GET['id']])->findOrFail();

authorize($note['user_id'] === $currentUserId);

$db->query('DELETE FROM notes WHERE id=?', [$_POST['id']]);

header('location: /notes');
exit();
