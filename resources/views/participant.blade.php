<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Tambah Data</title>
</head>
<body>
  <form action="{{ route('participant.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" id="file">
    <button type="submit">Tambah data</button>
  </form>
  <a href="{{ route('participant.create') }}" style="display:inline-block;margin-top:10px">Download Hasil</a>
</body>
</html>