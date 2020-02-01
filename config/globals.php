<?php
// $GLOBALS['sitename'] = "Canil Records";
// $GLOBALS['base_url'] = "http://localhost/canil";
// $GLOBALS['admin_base_url'] = "http://localhost/canil/admin";
// $GLOBALS['uri'] = "C:\wamp64\www\canil";
// $GLOBALS['admin_uri'] = "C:\wamp64\www\canil\admin";

$GLOBALS['sitename'] = "Canil Records";
$GLOBALS['base_url'] = "http://canilrec.com.br";
$GLOBALS['admin_base_url'] = "http://canilrec.com.br/admin";
$GLOBALS['uri'] = "public_html/";
$GLOBALS['admin_uri'] = "public_html/admin";


$GLOBALS['pages-prefix']['home'] = "hm";

// DATABASE
// $GLOBALS['database']['host'] = "127.0.0.1";
// $GLOBALS['database']['user'] = "root";
// // $GLOBALS['database']['pass'] = "";
// $GLOBALS['database']['pass'] = "ActiOhm@3629";
// $GLOBALS['database']['database'] = "canilrec";
$GLOBALS['database']['host'] = "187.45.196.157";
$GLOBALS['database']['user'] = "canilrec";
// $GLOBALS['database']['pass'] = "";
$GLOBALS['database']['pass'] = "ActiOhm@3629";
$GLOBALS['database']['database'] = "canilrec";


// API URLS
$GLOBALS['api']['artists'] = $GLOBALS['base_url']."/api/artists";
$GLOBALS['api']['tracks'] = $GLOBALS['base_url']."/api/tracks";
$GLOBALS['api']['contactmsg'] = $GLOBALS['base_url']."/api/contactmsg";
$GLOBALS['api']['genres'] = $GLOBALS['base_url']."/api/genres";
$GLOBALS['api']['ourservices'] = $GLOBALS['base_url']."/api/ourservices";
$GLOBALS['api']['processmodules'] = $GLOBALS['base_url']."/api/processmodules";
$GLOBALS['api']['scopes'] = $GLOBALS['base_url']."/api/scopes";
$GLOBALS['api']['sections'] = $GLOBALS['base_url']."/api/sections";
$GLOBALS['api']['socialmidias'] = $GLOBALS['base_url']."/api/socialmidias";
$GLOBALS['api']['pages'] = $GLOBALS['base_url']."/api/pages";
$GLOBALS['api']['users'] = $GLOBALS['base_url']."/api/users";
$GLOBALS['api']['usertypes'] = $GLOBALS['base_url']."/api/usertypes";
$GLOBALS['api']['mail'] = $GLOBALS['base_url']."/api/mail";
$GLOBALS['api']['chatmessages'] = $GLOBALS['base_url']."/api/chatmessages";
$GLOBALS['api']['calendar'] = $GLOBALS['base_url']."/api/calendar";
$GLOBALS['api']['chatusershasnewmessages'] = $GLOBALS['base_url']."/api/chatusershasnewmessages";


// PAGES MAPPING ID
$GLOBALS['pages']['home']['id'] = 1;
$GLOBALS['pages']['home']['title'] = "Home";
$GLOBALS['pages']['equipe']['id'] = 2;
$GLOBALS['pages']['equipe']['title'] = "Equipe";
$GLOBALS['pages']['profile']['id'] = 3;
$GLOBALS['pages']['profile']['title'] = "Profile";
$GLOBALS['pages']['trackdetail']['id'] = 4;
$GLOBALS['pages']['trackdetail']['title'] = "Track Detail";
$GLOBALS['pages']['formcontato']['id'] = 5;
$GLOBALS['pages']['formcontato']['title'] = "Contato";
$GLOBALS['pages']['tracks']['id'] = 6;
$GLOBALS['pages']['tracks']['title'] = "Tracks";

$GLOBALS['usertypeid']['admin'] = 1;
$GLOBALS['usertypeid']['coadmin'] = 6;
$GLOBALS['usertypeid']['editor'] = 2;