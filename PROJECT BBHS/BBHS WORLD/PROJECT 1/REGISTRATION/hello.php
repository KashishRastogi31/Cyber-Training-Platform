<?php
header('Content-Type: application/json');

$user_data = [
    'Name' => 'John Doe',
    'Email' => 'john@example.com',
    'Gender' => 'Male',
    'DOB' => '1990-01-01',
    'State' => 'California',
    'Profession' => 'Engineer',
    'Username' => 'johndoe'
];

echo json_encode($user_data);
?>
