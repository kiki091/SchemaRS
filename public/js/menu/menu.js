function menuRegistration()
{
    $('.right_col').load(laroute.url('/registration', []), function()
    {
    	initDataRegistration()
    });
}

function menuRegistrationInpatient()
{
    $('.right_col').load(laroute.url('/registration/inpatient', []), function()
    {
    	initDataRegistrationInpatient()
    });
}

function menuDoctor()
{
    $('.right_col').load(laroute.url('/doctor', []), function()
    {
    	initDataDoctor()
    });
}