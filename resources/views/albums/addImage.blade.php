@extends('layouts.app_album')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Add Images
                </div>
                <div class="float-end">
                    <a href="{{ route('albums.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('albums.storeImage', $id ) }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3 row">
                        <label for="image" class="col-md-4 col-form-label text-md-end text-start">Image</label>
                        <div class="col-md-6">
                          <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{ old('image')}} ">
                            @if ($errors->has('image'))
                                <span class="text-danger">{{ $errors->first('image') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="short_description" class="col-md-4 col-form-label text-md-end text-start">Short Description</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description" value="{{ old('short_description') }}">
                            @if ($errors->has('short_description'))
                                <span class="text-danger">{{ $errors->first('short_description') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Add Image">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>    
</div>

@endsection