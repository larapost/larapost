@extends('larapost::layouts.dashboard')
@section('title', 'Dashboard')
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Posts ({{ $statistics->countAll }})</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    All posts
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <a href="{{ route('larapost.posts.index') }}?status=publish">Published <b>({{ $statistics->publish }})</b></a> |
                    <a href="{{ route('larapost.posts.index') }}?status=draft">Draft <b>({{ $statistics->draft }})</b></a> |
                    <a href="{{ route('larapost.posts.index') }}?status=delete">Recycle Bin <b>({{ $statistics->remove }})</b></a>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Categories</th>
                                    <th>Tags</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($posts as $post)
                                <tr>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->id_author }}</td>
                                    <td>{{ $post->type }}</td>
                                    <td>-</td>
                                    <td>{{ $post->published_at }}</td>
                                    <td>
                                        <a href="{{ route('larapost.posts.edit', [$post->id]) }}" class="btn btn-xs btn-primary">Edit</a>
                                        <a onclick="event.preventDefault(); document.getElementById('delete-post-{{ $post->id }}').submit();" class="btn btn-xs btn-danger">Delete</a>
                                        <form id="delete-post-{{ $post->id }}" action="{{ route('larapost.posts.delete', [$post->id]) }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
@endsection