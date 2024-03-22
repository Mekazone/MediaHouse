@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Adverts</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @if (\Session::has('success'))
                      <div class="alert alert-success">
                          <p>{{ \Session::get('success') }}</p>
                      </div><br />
                      @endif
                    
                    <a href="{{ action('Admin\AdsController@create') }}" class="btn btn-primary btn-sm">New</a><hr />
                    
                    @if($ads > 0)
                        <table class="table table-bordered">
                        <tr><th>Title</th><th>URL</th><th>Ad Type</th><th>Duration</th><th>Status</th></tr>
                        @foreach($results as $result)
                            <tr><td><b><a href="/{{ $result->image_name }}">{{ $result->title }}</a></b></td>
                                <td>
                                @if(count($result->url)>0)
                                    <a href="{{$result->url}}" target="_blank">{{$result->url}}</a>
                                @endif
                                </td>
                                <td>{{ $result->image_dimension }}</td>
                                <td>{{ date('M d, Y', $result->start_date) }} to {{ date('M d, Y', $result->end_date) }}</td>
                                @if($result->end_date < $presentDate)
                                    <td>Expired</td>
                                @elseif($result->start_date <= $presentDate AND $result->end_date > $presentDate)
                                    <td>Active</td>
                                @elseif($result->start_date > $presentDate)
                                    <td>Pending</td>
                                @endif
                                
                                @if($admin_id == 2)
                                    <td>{{ Form::open(['method' => 'delete', 'route' => ['ads.destroy', $result->id]])}} {{ Form::submit('Delete', ['class' => 'btn btn-sm btn-danger', 'onclick' => 'return confirm("Are you sure you want to delete?")']) }} {{Form::close() }}</td>
                                @endif
                            </tr>
                        @endforeach() 
                        </table>
                        <div class="paginate">{{ $results->links() }}</div>  
                    @endif                                        
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
