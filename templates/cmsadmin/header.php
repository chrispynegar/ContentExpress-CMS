<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" media="screen" href="../templates/cmsadmin/css/jquery-ui-1.8.20.custom.css" />
    <link rel="stylesheet" media="screen" href="../templates/cmsadmin/css/style.css" />
</head>
<body>
    
    <header>
        <header class="header-left">
            <h1>Content Express CMS</h1>
        </header>
        <header class="header-right">
            <p>You are logged in as <a href="#" title="<?php echo $_SESSION['user_username']; ?>"><?php echo $_SESSION['user_username']; ?></a></p>
            <p>You currently have <a href="#" title="2 Unread Messages">2</a> unread messages</p>
        </header>
    </header>
    
    <div id="wrapper">
        <ul id="nav">
        	<li><a href="./">Dashboard</a></li>
            <li class="dropdown">
            	<a href="#" class="seperator">Content</a>
                <ul class="subnav">
                    <li><a href="#">Articles</a></li>
                    <li><a href="#">Pages</a></li>
                    <li><a href="#">Products</a></li>
                    <li><a href="#">Categories</a></li>
                    <li><a href="#">Modules</a></li>
                </ul>
            </li>
            <li class="dropdown">
            	<a href="#" class="seperator">Menu</a>
                <ul class="subnav">
                    <li><a href="#">Create</a></li>
                    <li><a href="#">Manage</a></li>
                    <li><hr /></li>
                    <li><a href="#">Main Menu</a></li>
                    <li><a href="#">Footer Menu</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="seperator">User</a>
                <ul>
                    <li><a href="./user-manager.php">Manage</a></li>
                    <li><a href="#">Notifications</a></li>
                    <li><a href="#">Messages</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="seperator">Extensions</a>
                <ul>
                    <li><a href="#">Templates</a></li>
                    <li><a href="#">Components</a></li>
                    <li><a href="#">Install</a></li>
                </ul>
            </li>
            <li class="dropdown">
	            <a href="#" class="seperator">Tools</a>
	            <ul>
	            	<li><a href="#">Settings</a></li>
	            	<li><a href="#">Logs</a></li>
	            </ul>
            </li>
            <li><a href="./logout.php">Logout</a></li>
        </ul>
        <div id="main-content">
	        <h2><?php echo $title; ?></h2>
	        <?php $system->message(); ?>