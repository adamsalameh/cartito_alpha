@extends('layout')
@section('content')

<!-- Content here -->
<form method="POST" action="/productImages/{{$productImage->id}}"enctype="multipart/form-data">
    @csrf
    @method('PATCH')    

    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
        </div>

        <div class="custom-file">
            <input type="file" name='image' class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection