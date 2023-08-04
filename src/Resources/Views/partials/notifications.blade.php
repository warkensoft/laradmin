@section('notifications')

    @if (!empty($errors) AND count($errors) > 0)
    <x-laradmin::notification class="text-red-800 bg-red-100">
        <x-slot:title> @lang('laradmin::laradmin.warning') </x-slot:title>
        <ul>
            @foreach ($errors as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </x-laradmin::notification>
    @endif

    @if ($message = Session::get('success'))
        <x-laradmin::notification class="text-green-800 bg-green-100">
            {!! nl2br($message) !!}
        </x-laradmin::notification>
    @endif

    @if ($message = Session::get('error'))
        <x-laradmin::notification class="text-red-800 bg-red-100">
            <x-slot:title> @lang('laradmin::laradmin.error') </x-slot:title>
            {!! nl2br($message) !!}
        </x-laradmin::notification>
    @endif

    @if ($message = Session::get('warning'))
        <x-laradmin::notification class="text-amber-800 bg-amber-100">
            <x-slot:title> @lang('laradmin::laradmin.warning') </x-slot:title>
            {!! nl2br($message) !!}
        </x-laradmin::notification>
    @endif

    @if ($message = Session::get('info'))
        <x-laradmin::notification class="text-blue-800 bg-blue-100">
            {!! nl2br($message) !!}
        </x-laradmin::notification>
    @endif

    @if ($message = Session::get('message'))
        <x-laradmin::notification class="text-indigo-800 bg-indigo-100">
            @if($message_title = Session::get('message_title'))
            <x-slot:title>{{ Session::get('message_title') }}</x-slot:title>
            @endif
            {!! nl2br($message) !!}
        </x-laradmin::notification>
    @endif

@show

