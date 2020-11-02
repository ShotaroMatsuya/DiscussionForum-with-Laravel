<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 10px 25px;
                font-size: 16px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                background-color:  rgb(168, 210, 223);
                border-radius: 3px;
            }
            .links > a:hover{
                background-color: #1b5674;
                color:rgb(168, 210, 223);
            }


            .m-b-md {
                margin-bottom: 30px;
            }
            .slideText{
                font-size: 24px;
                font-weight: bold;
                letter-spacing: 1.2;

            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/discussions') }}">Discussions</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    質問投議場
                </div>
                <div class="quote">
                    <p class="slideText">A foolish speaks, the wise listens.</p>

                </div>

                <div class="links">
                <a href="{{route('discussions.index')}}">Discussionを覗いてみる</a>

                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <script src="{{asset('js/jquery.slide-text-left.js')}}"></script>
<script>
$(function() {
  $(".slideText").slideTextLeft({
    words: ["愚者は語り、賢者は聞く by ソロモン -旧約聖書『箴言』","賢者は、話すべきことがあるから口を開く。愚者は、話さずにはいられないから口を開く。 by プラント", "知恵ある人は聞いて判断力を増し、分別ある人は導きを得る。 by ソロモン ー旧約聖書『箴言』", "知恵ある人は忠告に聞き従う。 by ソロモン -旧約聖書『箴言』","知る者は言わず、言う者は知らず by 『老子』-第56章","無知な者の口には高ぶりの芽、知恵ある人の唇は自分を守る。 by ソロモン -旧約聖書『箴言』","賢者が愚者から学ぶ事の方が、愚者が賢者に学ぶことより多い by モンテーニュ -『エセー』III-８"],
    delay: 2000
  });
});
</script>

    </body>
</html>
