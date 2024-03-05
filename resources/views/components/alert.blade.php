  {{-- inicio mnensagem de sucesso --}}
@if(session('success'))
  {{-- <div class="alert alert-success" role="alert">
      {{session('success')}}
  </div> --}}

  <script>
    document.addEventListener('DOMContentLoaded', ()=>{
        Swal.fire({
            title: 'Pronto!',
            html: '{{ session('success') }}',
            icon: 'success'
        })
    })
  </script>
@endif
{{-- fim mensagem de sucesso --}}

{{-- mensagem de erro --}}
@if(session('error'))
  {{-- <div class="alert alert-danger" role="alert">
      {{session('error')}}
  </div> --}}

  <script>
    document.addEventListener('DOMContentLoaded', ()=>{
        Swal.fire({
            title: 'Erro!',
            html: '{{ session('error') }}',
            icon: 'error'
        })
    })
  </script>
@endif
{{-- fim de erro --}}

{{-- inicio mensagem de campos obrigatorios --}}
@if($errors->any())
{{-- <div class="alert alert-danger" role="alert">
    @foreach ($errors->all() as $error)
        {{$error}} <br>
    @endforeach
</div> --}}

@php
    $message="";
    foreach ($errors->all() as $error) {
       $message .= $error . '<br>';
    }
@endphp

<script>
    document.addEventListener('DOMContentLoaded', ()=>{
        Swal.fire({
            title: 'Erro!',
            html: '{!! $message !!}',
            icon: 'error'
        })
    })
  </script>
@endif
{{-- fim msg de campos --}}
