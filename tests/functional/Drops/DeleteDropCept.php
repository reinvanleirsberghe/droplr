<?php

$I = new FunctionalTester($scenario);

// setup
$I->am('member');
$I->wantTo('delete a drop');

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

$I->see('Drop 1');

// Delete a drop
$I->click('Delete');

$I->seeCurrentUrlEquals('/user/drops');
$I->see('You currently have no drops added');