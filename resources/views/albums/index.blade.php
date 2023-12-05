@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Album List</div>
    <div class="card-body">
        @can('create-album')
            <a href="{{ route('albums.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New Album</a>
        @endcan
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($albums as $album)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $album->title }}</td>
                    <td>{{ $album->description }}</td>
                    <td>
                        <form action="{{ route('albums.destroy', $album->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <a href="{{ route('albums.show', $album->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>

                            @can('edit-album')
                                <a href="{{ route('albums.addImage', $album->id) }}" class="btn btn-info btn-sm"><i class="bi bi-file-earmark-plus"></i> Add Images</a>
                            @endcan

                            @can('edit-album')
                                <a href="{{ route('albums.edit', $album->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                            @endcan

                            @can('delete-album')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this album?');"><i class="bi bi-trash"></i> Delete</button>
                            @endcan
                        </form>
                    </td>
                </tr>
                @empty
                    <td colspan="4">
                        <span class="text-danger">
                            <strong>No Album Found!</strong>
                        </span>
                    </td>
                @endforelse
            </tbody>
        </table>

        {{ $albums->links() }}

    </div>
</div>
@endsection