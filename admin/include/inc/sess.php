<?
session_name("painel-admin");
session_start();

session_set_cookie_params( 
    2*60*60, 
    '/', 
    'www.saguarocomunicacao.com', 
    false, 
    true 
);



?>