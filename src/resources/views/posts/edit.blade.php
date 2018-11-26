@extends('larapost::layouts.dashboard')
@section('title', 'Dashboard')
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Create post</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <form role="form" action="{{ route('larapost.posts.update', [$post->id]) }}" method="post">
    <input type="hidden" name="_method" value="PUT">
    @csrf
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Basic Form Elements
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label>Title Post</label>
                        <input name="title" class="form-control" value="{{ $post->title }}">
                        @if ($errors->has('title'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Content Post</label>
                        <textarea name="content" class="form-control" rows="9">{{ $post->content }}</textarea>
                        @if ($errors->has('content'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('content') }}</strong>
                        </span>
                        @endif
                    </div>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->

            <div class="panel panel-default">
                <div class="panel-heading">Excerpt Post</div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <textarea name="excerpt" class="form-control" rows="5">{{ $post->excerpt }}</textarea>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <div class="col-lg-4">

            <div class="panel panel-default">
                <div class="panel-heading">Publish</div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="publish" @if($post->status == 'publish') selected @endif>publish</option>
                            <option value="draft" @if($post->status == 'draft') selected @endif>Draft</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Publish at</label>
                        <input name="published_at" type="date" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->

            <div class="panel panel-default">
                <div class="panel-heading">Categories</div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="form-group">
                        @foreach($categories as $categorie)
                        <div class="checkbox">
                            <label>
                                <input name="categories_main[]" type="checkbox" value="{{ $categorie->id }}" @if(in_array($categorie->id, $categories_selected['main'])) checked @endif>{{ $categorie->name }}
                            </label>

                            @foreach($categorie->subs as $sub)
                            <div class="checkbox" style="margin-left: 19px;">
                                <label>
                                    <input name="categories_sub[]" type="checkbox" value="{{ $sub->id }}" @if(in_array($sub->id, $categories_selected['sub'])) checked @endif>{{ $sub->name }}
                                </label>
                            </div>
                            @endforeach

                        </div>
                        @endforeach
                        @if($categories->isEmpty())
                        <div class="text-center">Not have categories</div>
                        @endif
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
    </form>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
@endsection