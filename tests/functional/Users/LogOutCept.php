<?php

$I = new FunctionalTester($scenario);

// setup
$I->am('member');
$I->wantTo('log out from the site');

$I->signIn();

// action
$I->click('Log Out');

// results
$I->seeCurrentUrlEquals('');
$I->see('You have now been logged out');



