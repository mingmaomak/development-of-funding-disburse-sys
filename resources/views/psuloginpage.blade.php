<?php
//! require('./config.php');
//! require ('/oauthconfig.blade.php');
include(app_path().'/oauthconfig.php');
header('location:'.$oauth_authorize_url.'?client_id='.$client_id.'&redirect_uri='.$redirect_uri.'&response_type=code&state='.md5(date('Y-m-d H:i:s')));

