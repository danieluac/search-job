@extends('layouts.app')


@section('content')

<div class="container-fluid p-sm-3 p-md-5">
   <div class="col-md-12 m-auto">
   <div class="card">
        <div class="card-header">
            <p class="text-center m-0">
                <strong>Actualize sua vaga</strong>
            </p>            
        </div>
        <div class="card-body">
            <div class="col-md-12">
                    @include('components.messages')
            </div>
            <form action="{{route('update_jobs',[$job->id])}}" method="post" >
            @method("POST")
            @csrf
                <div class="row">
                    <div class="col-md-12">
                        <label for="">Titulo</label>
                        <input required="" name="job_title" value="{{$job->job_title}}" type="text" class="form-control">
                    </div>                                     
                    <div class="col-md-6 mt-3">
                            <label class="" for="status">Número de vagas</label>
                            <input required=""  name="job_number" value="{{$job->job_number}}" type="number" class="form-control" />
                            <input name="job_id" value="{{$job->id}}" type="hidden" class="form-control" />                       
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="degree_id">Titulo Academico</label>
                        <select required="" class="form-control" value="{{$job->degree_id}}" name="degree_id" id="degree_id" required="">
                            <option selected disabled>Selecione: </option>
                           @foreach($degrees as $degree)                            
                            @if( $job->degree_id == $degree->id)
                              <option selected value="{{$degree->id}}">{{$degree->name}}</option>
                            @else
                              <option value="{{$degree->id}}">{{$degree->name}}</option>
                            @endif
                           @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="degree_id">Área de actividade</label>
                        <select required="" class="form-control" value="{{$job->activity_id}}" name="activity_id" id="degree_id" required="">
                            <option selected disabled>Selecione: </option>
                           @foreach($activities as $degree)                           
                              @if( $job->activity_id == $degree->id)
                                <option selected value="{{$degree->id}}">{{$degree->name}}</option>
                              @else 
                                <option value="{{$degree->id}}">{{$degree->name}}</option>
                              @endif
                           @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mt-3">
                            <label for="">Data de fim</label>
                            <input required="" name="end_date" type="date" value="{{$job->end_date}}" class="form-control">
                    </div>
                    <div class="col-md-12 mt-3">
                        <label for="">Municipio/Provincia de Localidade</label>
                        <input required="" name="job_location" value="{{$job->job_location}}" type="text" class="form-control">
                    </div>   
                    <div class="col-md-12">
                        <label for="">Descrição</label>
                        <textarea id="editor" required="" name="job_description" type="text" class="form-control">
                        {!! $job->job_description !!}      
                        </textarea>
                    </div>
                    <div class="col-12 mt-3">
                        <button class="btn btn-success pull-right"> 
                        <i class="fa fa-edit"></i> Actualizar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>  
   </div>  
   
</div>

@endsection

@section("styles")

@endsection
@section("scripts")
<script src="{{ asset('tinymce_5.6.2/tinymce/tinymce.min.js') }}"></script>
<script>
var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
tinymce.init({
    selector: '#editor',
    height: 1050,
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