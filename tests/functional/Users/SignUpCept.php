<?php

$I = new FunctionalTester($scenario);

// setup
$I->am('guest');
$I->wantTo('sign up on the site');

$I->amOnPage('/');

// actions
$I->click('Sign Up');

// verifications
$I->seeCurrentUrlEquals('/signup');

// actions
$I->fillField('firstname', 'Foo');
$I->fillField('name', 'Bar');
$I->fillField('email', 'foobar@example.com');
$I->fillField('password', 'secret');
$I->click('submit');

// results
$I->seeCurrentUrlEquals('/user/account');
$I->see('Welcome on');
$I->seeRecord('users', [
	'firstname' => 'Foo',
	'name'      => 'Bar',
	'email'     => 'foobar@example.com'
]);

// check if user is logged in
$I->assertTrue(Auth::check());