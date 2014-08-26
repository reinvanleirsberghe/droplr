<?php

$I = new FunctionalTester($scenario);

// setup
$I->am('member');
$I->wantTo("edit a drop's info");

$I->SignIn();

$I->amOnpage('/drops/add');
$I->addADropp('Drop 1', 'Dit is een eerste drop');

$I->seeRecord('drops', [
	'name'        => 'Drop 1',
	'description' => 'Dit is een eerste drop'
]);

$I->amOnpage('/user/drops');

// Edit a drop
$I->click('Drop 1');

$I->seeInCurrentUrl('/drops/edit');
$I->click('Edit info');

$I->seeInCurrentUrl('/drops/info');

$I->fillField('name', 'Drop gewijzigd');
$I->fillField('description', 'Deze drop werd gewijzigd');
$I->click('submit');

$I->see('Drop has been successfully edited');

$I->dontSeeRecord('drops', [
	'name'        => 'Drop 1',
	'description' => 'Dit is een eerste drop'
]);

$I->seeRecord('drops', [
	'name'        => 'Drop gewijzigd',
	'description' => 'Deze drop werd gewijzigd'
]);

