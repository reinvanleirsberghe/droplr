<?php

$I = new FunctionalTester($scenario);

// setup
$I->am('member');
$I->wantTo('log in on the site');

// actions
$I->SignIn();

// results
// check if user is logged in
$I->seeCurrentUrlEquals('');
$I->see('Welcome back');
$I->assertTrue(Auth::check());
