<?php
$ap_device = New Mobile_Detect();

if ( $ap_device->isMobile() ) {
	require_once "anwaelte_mobile.php";
} else {
	require_once "anwaelte_desktop.php";
}