function gd_load()
{
	return load();
}

function gd_save(data)
{
  console.log(data);
	save(data);
}

function gd_get_user_status()
{
	return isLoggedIn();
}