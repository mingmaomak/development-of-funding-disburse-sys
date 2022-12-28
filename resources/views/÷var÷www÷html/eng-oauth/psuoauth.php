<?php
/** This simple code for oauth2 client  */
/** Author : Thawat varachai email: thawat.va@psu.ac.th */

require('config.php');
header('location:'.$oauth_authorize_url.'?client_id='.$client_id.'&redirect_uri='.$redirect_uri.'&response_type=code&state='.md5(date('Y-m-d H:i:s')));
