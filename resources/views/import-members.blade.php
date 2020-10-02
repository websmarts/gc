@extends('layouts.main')

@section('content')

<form method="post" action="uploadfile" enctype="multipart/form-data"> 
@csrf 

<input type="file" name="spreadsheet">

<input type="submit" name="b">Upload file</input>

</form>


@endsection