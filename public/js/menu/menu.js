function menuRegistration()
{
    $('.right_col').load(laroute.url('/registration', []), function()
    {
    	initDataRegistration()
    });
}