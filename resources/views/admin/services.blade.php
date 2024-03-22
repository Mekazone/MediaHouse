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
                    
                    @if ($aboutUs == 0)
                    
                    <div>
                        <form action="{{action('Admin\AboutController@store')}}" method="post" enctype="multipart/form-data">
                        <input name="slug" type="hidden" value="{{ $slug }}">
                        {{ csrf_field() }}
                          <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Enter title">
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
                            <textarea class="form-control" name="body" id="mytextarea" rows="8"></textarea>
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
                    @else
                    <a href="{{ action('Admin\AboutController@edit', $slug) }}" class="btn btn-primary btn-sm">Edit</a><br /><br /> 
                        <div><h4>{{ $result->title }}</h4></div>
                        
                        @if($topImages)
                            @foreach($topImages as $attachment)
                                    @if($attachment->fileCategoryId == 1)
                                        <div class="results"><img class="img-thumbnail" src="/{{ $attachment->name }}" /></div>
                                        @if($attachment->caption)
                                            <div class="caption">{{ $attachment->caption }}</div>
                                        @endif
                                    @endif   
                            @endforeach
                        @endif
                        
                        <div class="postBody">{!! $result->body !!}</div>
                        
                        @if($bottomAttachments)
                            @foreach($bottomAttachments as $attachment)
                                    @if($attachment->fileCategoryId == 1)
                                        <span class="results"><img class="img-thumbnail" src="/{{ $attachment->name }}" /></span>
                                        @if($attachment->caption)
                                            <div class="caption">{{ $attachment->caption }}</div>
                                        @endif
                                    @elseif($attachment->fileCategoryId == 2)
                                        @if($attachment->caption)
                                            <div class="results"><a href="/{{ $attachment->name }}">{{ $attachment->caption }}</div>
                                        @else
                                            <div class="results"><a href="/{{ $attachment->name }}">Click to view document</a></div>
                                        @endif
                                        
                                    @endif   
                            @endforeach  
                       @endif      
                    
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
