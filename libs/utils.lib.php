<?php

function getSubdomain()
{
	$exploded_domain = explode('.',$_SERVER['SERVER_NAME']);
	return $exploded_domain[0];
}

function retrieve_fields($sf)
{
    return json_encode($sf);
}

function verify_fields($f,$sf)
{
	$fields = json_encode($sf);
    return (strcmp($fields,$f) === 0);
}