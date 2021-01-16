@extends('layouts.app')

@section("page_title","Mensagem - ".$sms->job_title)
@section('content')

<div class="container-fluid p-4">
    <div class="row">      
       <div class="col-md-12 job_card">
            <div class="card col-md-7 p-0 mb-4 m-auto ">
                <div class="card-header bg-dark text-white p-2 pl-4">
                    <p class="p-0 m-0"><strong>{{$sms->title}}</strong>
                    @if(auth::user()->id != $sms->from)
                        <a href="#" class="btn p-0 pl-2 pr-2 m-0 btn-info pull-right btnResponse">
                            <i class="fa fa-share"></i>
                                            Responder                           
                        </a>
                    @else
                        <a href="#" class="btn p-0 pl-2 pr-2 m-0 btn-info pull-right disabled">
                            <i class="fa fa-share"></i>
                                                Enviado                           
                        </a>
                    @endif
                       
                    </p>                
                </div>
                <div class="card-body bg-dark text-white">
                    <div>     
                    <p class="m-0 p-0">
                      <small>
                        De: {{$sms->sent_from->name}} - {{$sms->sent_from->email}} <br>
                        Para: {{$sms->sent_to->name}} - {{$sms->sent_from->email}}
                      </small>
                    </p>
                    <hr>                                                     
                    <div class="drecription">
                            {!! $sms->message !!}
                    </div>
                    </div>
                    <form id="responseForm" class="mt-5" action="{{route('store_message')}}" method="post" >
            @method("POST")
            @csrf
            <br><br><br><br>
            <hr>
                <div class="row"> 
                    <div class="col-md-12">
                        <label for="">Assunto:</label>
                        <input required="" name="title" value="{{$sms->title}} " type="text" class="form-control">
                        <input  name="from_id" value="{{auth::user()->id}}" type="hidden" class="form-control">
                        <input required="" name="to_id" value="{{$sms->from}}" type="hidden" class="form-control">
                    </div>                   
                    <div class="col-md-12">
                        <label for="">Descrição:</label>
                        <textarea id="editor" required="" name="message" value="{{old('message')}}" type="text" class="form-control">
                        
                        </textarea>
                    </div>
                    <div class="col-12 mt-3">
                        <button class="btn btn-success pull-right"> 
                        <i class="fa fa-plus-circle"></i> Responder
                        </button>
                    </div>
                </div>
        </form>
                </div>
            </div> 
            
        </div>
       
    </div>

</div>

@endsection

@section("scripts")
<script src="{{ asset('tinymce_5.6.2/tinymce/tinymce.min.js') }}"></script>
<script>

    $("#responseForm").hide();
    var state = 1;
    $(".btnResponse").click(function(){
        if(state == 1){
            state = 0;
            $("#responseForm").show();
        }else if(state == 0){
            state = 1;
            $("#responseForm").hide();
        }
    });

var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
tinymce.init({
    selector: '#editor',
    height: 350,
  plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
  imagetools_cors_hosts: ['picsum.photos'],
  menubar: 'file edit view insert format tools table help',
  toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
  toolbar_sticky: true,
  autosave_ask_before_unload: true,
  autosave_interval: '30s',
  autosave_prefix: '{path}{query}-{id}-',
  autosave_restore_when_empty: false,
  autosave_retention: '2m',
  image_advtab: true,
  link_list: [
    { title: 'My page 1', value: 'https://www.tiny.cloud' },
    { title: 'My page 2', value: 'http://www.moxiecode.com' }
  ],
  image_list: [
    { title: 'My page 1', value: 'https://www.tiny.cloud' },
    { title: 'My page 2', value: 'http://www.moxiecode.com' }
  ],
  image_class_list: [
    { title: 'None', value: '' },
    { title: 'Some class', value: 'class-name' }
  ],
  importcss_append: true,
  file_picker_callback: function (callback, value, meta) {
    /* Provide file and text for the link dialog */
    if (meta.filetype === 'file') {
      callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
    }

    /* Provide image and alt text for the image dialog */
    if (meta.filetype === 'image') {
      callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
    }

    /* Provide alternative source and posted for the media dialog */
    if (meta.filetype === 'media') {
      callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
    }
  },
  templates: [
        { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
    { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
    { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
  ],
  template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
  template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
 
  image_caption: true,
  quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
  noneditable_noneditable_class: 'mceNonEditable',
  toolbar_mode: 'sliding',
  contextmenu: 'link image imagetools table',
  skin: useDarkMode ? 'oxide-dark' : 'oxide',
  content_css: useDarkMode ? 'dark' : 'default',
  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
 
    
});
</script>
@endsection