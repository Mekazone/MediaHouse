@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    
                    @if (count($errors) > 0)
                        <div class="alert alert-warning">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        </div>
                    @endif
                    
                    <div>
                        <form action="{{ action('Admin\AboutController@update', $results->slug )}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="PATCH">
                        <input name="slug" type="hidden" value="{{ $slug }}">
                          <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title" value="{{ $results->title }}">
                          </div>
                          <div id="topImages">
                              <div class="form-group">
                                  <div id="topImagesContainer">
                                    <label for="topImages">Top Image</label>
                                    <div class="uploadFile">
                                    <input type="file" class="form-control" name="topAttachment">
                                <input type="hidden" name="fileTypeTop" value="1" /> 
                                  </div>
                                  </div>
                              </div>
                              
                              <div class="form-group">
                                <label for="topCaption">File Caption</label>
                                <input type="text" class="form-control" name="topCaption" id="topCaption" placeholder="Enter file caption">
                              </div>
                          </div>
                          
                          
                          <div class="form-group">
                            <label for="mytextarea">Body</label>
                            <textarea class="form-control" name="body" id="mytextarea" rows="8">{!! $results->body !!}</textarea>
                          </div>
                          
                          <div class="form-group" style="margin-top: 10px;">
                              <div id="bottomImagesContainer">
                                <label for="bottomImages">Bottom Attachment(s)</label>
                                <div class="uploadFile" id="bottomImages">
                                <input type="file" class="form-control" name="bottomAttachments[]">
                                <div class="form-group" style="margin-top: 10px;">
                            <label for="bottomCaption">File Caption</label>
                            <input type="text" class="form-control" name="bottomCaption[]" id="bottomCaption" placeholder="Enter file caption">
                          </div>
                          
                              <div class="fileType"><label>File Type (choose one option)</label></div>
                            <span class="fileTypeValues"><input type="checkbox" name="fileTypeBottom[]" value="1" /> Image </span>
                            <span class="fileTypeValues"><input type="checkbox" name="fileTypeBottom[]" value="2" /> Document </span>         
                            </div>
                              </div>
                              <div style="margin: 10px 0;"><button id="extraUpload2" class="btn btn-danger btn-sm" type="button" style="font-weight: bold;">Add more</button></div>
                          </div>
                          
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
</div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
