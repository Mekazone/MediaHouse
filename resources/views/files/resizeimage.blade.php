
<div class="panel panel-primary">
    <div class="panel-heading">Image upload after resize</div>
    <div class="panel-body">
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p class="error_item">{{ $error }}</p>
                @endforeach
            </div>
        @endif
        
        @if(Session::get('success'))
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-4">
                        <strong>Image before resize:</strong>    
                    </div>
                    <div class="col-md-8">
                        <img src="{{ asset('normal_images/'.Session::get('imagename')) }}" />
                    </div>
                </div>
                
                <div class="col-md-12" style="margin-top: 10px;">
                    <div class="col-md-4"><strong>Image after resize:</strong></div>
                    <div class="col-md-8">
                        <img src="{{ asset('thumbnail_images/'.Session::get('imagename')) }}" />
                    </div>
                </div>
            </div>
            @endif
            <form method="post" action="" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6">
                    <input type="file" name="photo" />
                    <br />
                    <button type="submit" class="btn btn-primary">Image</button>
                </div>
            </div>
            </form>
    </div>
</div>
