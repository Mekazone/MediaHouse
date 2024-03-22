<div id="contactform">
    <meta name="_token" content="{{ csrf_token() }}" /> 
    <ul>
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    </ul>
    {{ Form::open(array('route' => 'contact_store', 'id' => 'contact', 'name' => 'contact')) }}
        <input type="text" id="firstName" name="firstName" placeholder="{{ trans('index.first_name') }}" class="required" /><br />
        <input type="text" id="lastName" name="lastName" placeholder="{{ trans('index.last_name') }}" class="required" /><br />
        <input type="text" id="email" name="email" placeholder="{{ trans('index.email') }}" class="required email" /><br />
        <textarea id="message" name="message" cols="40" rows="5" placeholder="{{ trans('index.message') }}" class="required"></textarea><br />
        <input id="submit" class="send_it" name="submit" type="submit" value="{{ trans('index.submit_button') }}" />
    {{Form::close()}}
    <div id="response"></div>
    <div id="loading"><img src="frontend_assets/loader.gif" alt="loader"></div>
</div>

<script src="{{ asset('frontend_assets/js/app.js') }}"></script>
<script>
$(document).ready(function(){
    $('#loading').hide();
    $('#submit').click( function(e) {
     $.ajaxSetup({
         header:$('meta[name="_token"]').attr('content')
      })
      e.preventDefault;
      if( $('#contact').valid() ) {
         ajaxSubmit();
       }
       else {
           $('label.error').hide().fadeIn('slow');
       }
       });
   });

function ajaxSubmit() {
$('#loading').show();
$('#submit').attr('disabled', 'disabled');
var firstName = $('#firstName').val();
var lastName = $('#lastName').val();
var email = $('#email').val();
var message = $('#message').val();
var _token = $('[name="_token"]').val(),

var data = 'firstName=' +firstName+ '&lastName=' +lastName+ '&email=' +email+ '&message=' +message + '&_token=' + _token;

$.ajax({
    url: '/testmail',
    type: 'get',
    dataType: 'json',
    data: data,
    cache: false,
    success: function(response) {
            $('#loading, #contact, .message').fadeOut('slow');
            $('#response').html('<h3>Mail sent</h3>').fadeIn('slow');
    },
    error: function(jqXHR, textStatus, errorThrown) {
            $('#loading').fadeOut('slow');
            $('#submit').removeAttr('disabled');
            $('#response').text('Error Thrown: ' +errorThrown+ '<br>jqXHR: ' +jqXHR+ '<br>textStatus: ' +textStatus ).show();
    }
});
return false;
}

</script>