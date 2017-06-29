function validPassword(pass)
{
	pass = new String(pass);
	validPasswordArray = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ.,!@#$%^&*()-_+=`|"\'';
	for(i=0;i<pass.length;i++)
		if(validPasswordArray.indexOf(pass.charAt(i))==-1)
			return false;
	return true;
}

function validatePassword(email,pass)
{
	
}