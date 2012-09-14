function gd_analytics(category, action, label, value)
{
	_gaq.push(['_trackEvent', category, action, label, value]);
}