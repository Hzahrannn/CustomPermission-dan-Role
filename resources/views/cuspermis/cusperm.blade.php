<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="/c/buat" method="post">
		@csrf
		<p>Role</p>
		<select name="id_role">
			@foreach($role as $r)
			<option value="{{ $r->id_role }}"> {{ $r->nama_role}} </option>
			@endforeach
		</select>
		<br>
		<p>Permis</p>
		<select name="id_permis">
			@foreach($permis as $p)
			<option value="{{ $p->id_permis }}"> {{ $p->permis}} </option>
			@endforeach
		</select>
		<br>
		<button type="submit" class="btn btn-primary">
        Tambahkan Akses
        </button>
	</form>
</body>
</html>