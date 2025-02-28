@extends("$theme_dir.layouts.$layoutName")

{{-- {{dd($theme_dir, $layoutName)}} --}}
{{-- Content --}}
@section('content')
    <div class="container">
      <form action="/save" method="post">
        @csrf
        <select class="form-select" name="category" aria-label="Default select example">
          <option selected>Open this select menu</option>
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
        </select>

        <div class="mb-3">
          <label for="formGroupExampleInput" class="form-label">blog Title</label>
          <input type="text" name="title" class="form-control" id="formGroupExampleInput" placeholder="Enter Blog Title">
        </div>
        <div class="mb-3">
          <label for="exampleFormControlTextarea1" class="form-label">Blog Body </label>
          <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>

        {{-- <div class="mb-3">
          <label for="formFile" class="form-label">Blog Image</label>
          <input class="form-control" name="path" type="file" id="formFile" value="am the path">
        </div> --}}
        <button type="submit">POST</button>
      </form>
    </div>
 
@endsection

