<?php

spl_autoload_register(function($class) {
	
	$classes = array();
	
	$classes[] = 'app\\models\\MPostTable';
	$classes[] = 'app\\models\\MPostTableFunctions';
	$classes[] = 'app\\models\\MPostDaoObject';
	$classes[] = 'app\\models\\MPostDaoFactory';
	$classes[] = 'app\\models\\MUserTable';
	$classes[] = 'app\\models\\MUserTableFunctions';
	$classes[] = 'app\\models\\MUserDaoObject';
	$classes[] = 'app\\models\\MUserDaoFactory';
	
	if(in_array($class, $classes))
	{
		require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . substr($class, 11) . '.php';
	}
	
});
