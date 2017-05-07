function menuPasien()
{
    $('.right_col').load(laroute.url('/patient', []), function()
    {
    	initDataPasien()
    });
}