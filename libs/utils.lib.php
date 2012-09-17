<?php

function getSubdomain()
{
	return explode('.',$_SERVER['SERVER_NAME'])[0];
}