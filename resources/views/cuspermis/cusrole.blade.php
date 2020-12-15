<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="/r/buat" method="post">
		@csrf
		<p>Role</p>
		<select name="id_user">
			@foreach($user as $u)
			<option value="{{ $u->id }}"> {{ $u->name}} </option>
			@endforeach
		</select>
		<br>
		<p>Permis</p>
		<select name="id_role">
			@foreach($role as $r)
			<option value="{{ $r->id_role }}"> {{ $r->nama_role}} </option>
			@endforeach
		</select>
		<br>
		<button type="submit" class="btn btn-primary">
        Tambahkan Role
        </button>
	</form>
</body>
</html>