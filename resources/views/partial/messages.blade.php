@foreach (session()->pull('messages', []) as $message)
<div class="alert alert-light-{{$message['color'] ?? 'primary'}} alert-dismissible show fade shadow-sm">
    @isset($message['icon'])
        <i class="{{$message['icon']}}"></i>
    @endisset
    <strong>{{$message['text']}}</strong>
    @isset($message['link'])
        <a href="{{$message['link']['href']}}" class="link-{{$message['color'] ?? 'primary'}} text-decoration-underline fw-bold">
            {{$message['link']['text']}}
        </a>
    @endisset
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endforeach