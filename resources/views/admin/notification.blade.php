<div class="row">
    <div class="col-md-12">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>SUCCESS!</strong>
                @if(is_array($message))
                    @foreach ($message as $m)
                        {{ $m }}
                    @endforeach
                @else
                    {{ $message }}
                @endif
            </div>
        @endif
        <!-- <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <strong>Heads up!</strong> This alert needs your attention, but it's not super important.
        </div> -->
        @if ($message = Session::get('warning'))
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>WARNING!</strong>
                @if(is_array($message))
                    @foreach ($message as $m)
                        {{ $m }}
                    @endforeach
                @else
                    {{ $message }}
                @endif
            </div>
        @endif
        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>Oh snap!</strong>
                @if(is_array($message))
                    @foreach ($message as $m)
                        {{ $m }}
                    @endforeach
                @else
                    {{ $message }}
                @endif
            </div>
        @endif
    </div>
</div>