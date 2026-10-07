<?php

test('guest is redirected to login when opening the students page', function () {
    $this->get('/students')->assertRedirect('/login');
});

test('guest cannot create a student', function () {
    $this->post('/students', [
        'name' => 'Budi Santoso',
        'nis'  => '12345',
    ])->assertRedirect('/login');
});

test('guest cannot open the attendance page', function () {
    $this->get('/attendance')->assertRedirect('/login');
});

test('guest is redirected to login when opening the dashboard', function () {
    $this->get('/dashboard')->assertRedirect('/login');
});
