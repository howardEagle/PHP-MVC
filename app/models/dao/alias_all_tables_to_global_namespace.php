<?php

/*
 * Use this file to add all of your namespace generated database classes to the global namespace.
 * This can be useful while migrating to using namespaces.
 * This can be bit slow because PHP will open and parse every file listed below.
 * You might also consider including the vendor/parm/parm/use_global_namespace.php file
 *
 */

 
class_alias('app\\models\\MPostDaoObject', 'MPostDaoObject');
class_alias('app\\models\\MPostDaoFactory', 'MPostDaoFactory');
class_alias('app\\models\\MUserDaoObject', 'MUserDaoObject');
class_alias('app\\models\\MUserDaoFactory', 'MUserDaoFactory');

        ?>