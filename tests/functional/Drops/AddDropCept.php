<?php

$I = new FunctionalTester($scenario);

// setup
$I->am('member');
$I->wantTo('add a drop');

$I->SignIn();

$I->amOnpage('/user/drops');
$I->click('Add Drop');

$I->seeCurrentUrlEquals('/drops/add');
$I->fillField('name', 'Drop Brugge');
$I->fillField('geo', 'Brugge');
$I->fillField('lat', '51.209348');
$I->fillField('lng', '3.224699');
$I->fillField('formatted_address', 'Bruges, Belgium');
$I->click('submit');

$I->amOnpage('/user/drops');

$I->seeRecord('drops', [
	'name'        => 'Drop Brugge',
    'location'    => 'Bruges, Belgium',
    'lat'         => '51.209348',
    'lng'         => '3.224699'
]);
$I->see('Drop Brugge');