@foreach (session()->pull('messages', []) as $message)
<div class="alert alert-{{$message['color'] ?? 'primary'}} alert-dismissible show fade shadow-sm">
    @isset($message['icon'])
        <i class="{{$message['icon']}}"></i>
    @endisset
    <strong>{{$message['text']}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endforeach