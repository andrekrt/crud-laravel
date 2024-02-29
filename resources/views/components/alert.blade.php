  {{-- inicio mnensagem de sucesso --}}
  @if(session('success'))
  <div class="alert alert-success" role="alert">
      {{session('success')}}
  </div>
@endif
{{-- fim mensagem de sucesso --}}

{{-- mensagem de erro --}}
@if(session('error'))
  <div class="alert alert-danger" role="alert">
      {{session('error')}}
  </div>
@endif
{{-- fim de erro --}}     

{{-- inicio mensagem de campos obrigatorios --}}
@if($errors->any())
<div class="alert alert-danger" role="alert">
    @foreach ($errors->all() as $error)
        {{$error}} <br>
    @endforeach
</div>
@endif
{{-- fim msg de campos --}}