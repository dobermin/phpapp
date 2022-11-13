@if(isset($errors))
    {{ $error }}
    @foreach($errors[$error] as $err)
        <div>{{ $err }}</div>
    @endforeach
@endif