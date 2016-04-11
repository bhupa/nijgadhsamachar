<!DOCTYPE html>
<html>
<head>
	<title>email</title>
</head>
<body>
<P> Welcomes{{$user->firstname}} . Click <a href="{{ url('reset/password/'.$token) }}"> here </a> to reset your password </P>
</body>
</html>