<?php

$I = new FunctionalTester($scenario);

// setup
$I->am('member');
$I->wantTo('add a drop');

$I->SignIn();

$I->amOnpage('/user/drops');
$I->click('Add Drop');

$I->seeCurrentUrlEquals('/drops/add');
$I->addADropp('Drop Brugge', 'Dit is een drop in Brugge');

$I->amOnpage('/user/drops');

$I->seeRecord('drops', [
	'name'        => 'Drop Brugge',
	'description' => 'Dit is een drop in Brugge'
]);
$I->see('Drop Brugge');