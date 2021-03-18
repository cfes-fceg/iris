<!--suppress ALL -->
<img {{ $attributes->merge([
    'src' => Storage::disk('assets')->url('image/cfes-logo.svg'),
    'alt' => config('app.name')." Logo"
]) }}/>

