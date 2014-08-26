<?php

$I = new FunctionalTester($scenario);

// setup
$I->am('member');
$I->wantTo('delete a drop');

$I->SignIn();

$I->amOnpage('/drops/add');
$I->addADropp('Drop 1', 'Dit is een eerste drop');

$I->amOnpage('/user/drops');

$I->see('Drop 1');

// Delete a drop
$I->click('Delete');

$I->seeCurrentUrlEquals('/user/drops');
$I->see('You currently have no drops added');