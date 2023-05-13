{{--@if($errors->any())--}}
{{--    @foreach($errors->all() as $error)--}}
{{--        toastr.error("{{$error}}");--}}
{{--    @endforeach--}}
{{--@endif--}}

@if(session()->has('success'))
    toastr.success("{{session()->get('success')}}");
@endif

@if(session()->has('message'))
    toastr.success("{{session()->get('message')}}");
@endif

@if(session()->has('error'))
    toastr.success("{{session()->get('error')}}");
@endif

@if($errors->any())
    @foreach($errors->all() as $error)
        toastr.error("{{$error}}");
    @endforeach
@endif

