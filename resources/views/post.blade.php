@extends('layouts.app')
@section('content')
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="og:url" content="https://www.facebook.com/officepact/">

        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <title>Post to Social</title>

        <!-- Bootstrap core CSS -->


        <!-- font-awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Additional CSS Files -->
        <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/templatemo-digimedia-v3.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/animated.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">

    </head>
    <body >


    <div class="container">
        <div class="container mt-5 p-5">
            <div class="p-5" >
                <h2 class="text-center mb-2">{{ $post->title }}</h2>
                <img src="{{ asset('uploads')}}/{{ $post->image }}" alt="" class="img-fluid">
                <p>
                    {{ $post->description }}
                </p>
                <span class="badge bg-danger">{{ $post->category }}</span>
                <hr />
                <script>
                    window.fbAsyncInit = function() {
                        FB.init({
                            appId      : '1054345498727133',
                            xfbml      : true,
                            version    : 'v12.0'
                        });
                        FB.AppEvents.logPageView();
                    };

                    (function(d, s, id){
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) {return;}
                        js = d.createElement(s); js.id = id;
                        js.src = "https://connect.facebook.net/en_US/sdk.js";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));
                </script>

                <div class="fb-like"
                     data-layout="standard"
                     data-action="share"
                     data-size="large"
                     data-show-faces="true"
                     data-href="https://developers.facebook.com/docs/plugins/"
                     data-share="true">

                    <button type="submit" class="btn btn-primary">
                        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?
                        u={{ url()->current() }}"
                           class="social-button " id="" style="color:white">FB Post</a>
                    </button>

                </div>
                <script src="https://platform.linkedin.com/in.js" type="text/javascript">lang: en_US</script>
                <script type="IN/Share" data-url="{{url()->current()}}"></script>

                <div class="linkedin-share"
                     data-layout="standard"
                     data-action="share"
                     data-size="large"
                     data-show-faces="true"
                     data-href="https://platform.linkedin.com"
                     data-share="true">

                    <button type="submit" class="btn btn-primary">
                        <a target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?
                        url={{url()->current()}}"
                           class="social-button " id="" style="color:white">LinkedIn Post</a>
                    </button>
                </div>
                <div class="twitter-share"
                     data-layout="standard"
                     data-action="share"
                     data-size="large"
                     data-show-faces="true"
                     data-href="https://api.twitter.com"
                     data-share="true">
                    <button type="submit" class="btn btn-primary">
                        <a target="_blank" href="https://twitter.com/intent/tweet?text= &
                        url= {{url()->current()}}"
                           class="social-button " id="" style="color:white"> Tweet </a>
                    </button>
                </div>

                <form action="{{ route('AddComment')}}" method="POST">
                    @csrf
                    <input type="text" name="content" class="form-control">
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <hr />
                    <button type="submit" class="btn btn-primary">

                        Comment </button>
                </form>
            </div>
            <hr />
            <div >
                <h3><i class="fa fa-comments" aria-hidden="true"></i> Comments </h3>
                <hr />
                @foreach ($post->comments as $comment)

                    <h4 style="color:rgb(89, 123, 236);">{{ $comment->user->name }}</h4>
                    <ul class="container mt-2" style="display:flex;">
                        <li  style="margin-right:auto;">
                            {{ $comment->content }}
                        </li>

                        <li>
                            {{ $comment->created_at->format('D-m-Y H:i:s') }}
                        </li>
                    </ul>
                    <hr />
                @endforeach
            </div>
        </div>
    </div>



    <!-- Scripts -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('assets/js/animation.js') }}"></script>
    <script src="{{ asset('assets/js/imagesloaded.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>


@endsection
