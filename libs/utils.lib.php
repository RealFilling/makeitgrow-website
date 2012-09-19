<?php

function getSubdomain()
{
	$exploded_domain = explode('.',$_SERVER['SERVER_NAME']);
	return $exploded_domain[0];
}