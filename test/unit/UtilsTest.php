<?php
require_once dirname(__FILE__).'/../bootstrap/unit.php';

$t = new lime_test(1);
$t->pass('This test always passes.');

$t = new lime_test(6);
$t->is(Utils::getAge('1970-10-10', '2011-12-12'),41);
$t->is(Utils::getAge('1970-01-01', '2009-12-31'),39);
$t->is(Utils::getAge('1970-01-01', '2010-01-01'),40);
$t->is(Utils::getAge('2000-07-02', '2000-07-02'),0);
$t->is(Utils::getAge('2000-07-01', '2001-07-02'),1);
$t->is(Utils::getAge('2000-07-02', '2001-07-01'),0);

