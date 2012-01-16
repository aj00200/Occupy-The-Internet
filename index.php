<?php
require_once("header.php"); 

//right sidebar template
$tpl_sidebar = new Template("styles/".$style."/sidebar.php");
$tpl_sidebar->setVar("imagepath", './styles/'.$style.'/images/');     
$tpl_index = new Template("styles/".$style."/index_body.php");
$tpl_index->setVar("imagepath", './styles/'.$style.'/images/');  
//
//this is content,  the middle section
//
//$news_content;
include_once "news.php";
//This is the custom slider we added
include_once "slider.php";

 // $inc_latestplayers
/*****************************
* IMPORTANT!
* every include script must
* outout its content as a
* string, after that here
* page is printed in a templ.
* - $news_content (news.php)
******************************/

$tpl_index->setVar("news_content", $news_content); 
$tpl_index->setVar("slider", $slider);

/****************************
*****************************
*****************************/
if ($a_user['is_guest'])
{
  // add more coding here
}

//right sidebar print:
$tpl_index->setVar("sidebar_content", $tpl_sidebar->toString()); 

//FINALLY PRINT BODY TEMPLATE 
print $tpl_index->toString();
$tpl_footer = new Template("styles/".$style."/footer.php");
$tpl_footer->setVar("imagepath", 'styles/'.$style.'/images/');
print $tpl_footer->toString();


?>




