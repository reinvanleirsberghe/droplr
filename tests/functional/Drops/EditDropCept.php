<?php

$I = new FunctionalTester($scenario);

// setup
$I->am('member');
$I->wantTo("edit a drop's info");

$I->SignIn();

$I->amOnpage('/drops/add');
$I->fillField('name', 'Drop 1');
$I->fillField('geo', 'Brugge');
$I->fillField('lat', '51.209348');
$I->fillField('lng', '3.224699');
$I->fillField('formatted_address', 'Bruges, Belgium');
$I->click('submit');

$I->seeRecord('drops', [
	'name'        => 'Drop 1'
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
	'name'        => 'Drop 1'
]);

$I->seeRecord('drops', [
	'name'        => 'Drop gewijzigd',
	'description' => 'Deze drop werd gewijzigd'
]);

