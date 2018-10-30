@section('notifications')

    @if (!empty($errors))
        <div class="row notifications notifications-warning">
            <div class="col-sm-12">
                <div class="alert alert-warning ">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>@lang('message.warning')</strong> :
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    @if ($message = Session::get('success'))
        <div class="row notifications notifications-success">
            <div class="col-sm-12">
                <div class="alert alert-success ">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {!! nl2br($message) !!}
                </div>
            </div>
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="row notifications notifications-error">
            <div class="col-sm-12">
                <div class="alert alert-danger ">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>@lang('message.error')</strong> :
                    {!! nl2br($message) !!}
                </div>
            </div>
        </div>
    @endif

    @if ($message = Session::get('warning'))
        <div class="row  notifications notifications-warning">
            <div class="col-sm-12">
                <div class="alert alert-warning ">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>@lang('message.warning')</strong> :
                    {!! nl2br($message) !!}
                </div>
            </div>
        </div>
    @endif

    @if ($message = Session::get('info'))
        <div class="row notifications notifications-info">
            <div class="col-sm-12">
                <div class="alert alert-info ">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {!! nl2br($message) !!}
                </div>
            </div>
        </div>
    @endif

    @if ($message = Session::get('message'))
        <div class="row notifications notifications-message">
            <div class="col-sm-12">
                <div class="alert alert-info ">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    @if($message_title = Session::get('message_title'))
                        <strong>{{ $message_title }}</strong> :
                    @endif
                    {!! nl2br($message) !!}
                </div>
            </div>
        </div>
    @endif

@show

