@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Pending Comments</div>

                <div class="panel-body">                    
                    @if (\Session::has('success'))
                      <div class="alert alert-success">
                          <p>{{ \Session::get('success') }}</p>
                      </div><br />
                      @endif
                    
                    @if($query)
                        <div class="row">
                        <div class="col-lg-12">
                        <table class="table table-responsive table-hover table-bordered table-condensed">
                        <tr><th>Name</th><th>Comment</th><th>Post link</th><th>Category</th><th>Action</th></tr> 
                        @foreach($query as $comment)
                            <tr>
                                <td>{{ $comment->name }}</td>
                                <td>{{ $comment->comment }}</td>
                                <td><a href="/{{ $comment->category }}/{{ $comment->date }}/{{ $comment->slug }}">{{ $comment->title }}</a></td>
                                <td>{{ ucwords($comment->category) }}</td>
                                <td><a href="/admin/comments/{{ $comment->id }}/edit?category={{$comment->category}}&action=approve" class="btn btn-success btn-sm">Approve</a> <a href="/admin/comments/{{ $comment->id }}/edit?category={{$comment->category}}&action=delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')">Delete</a></td>
                            </tr>
                        @endforeach 
                        </table>           
                    @endif
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
