@extends('layouts.frontend')
@section('content')
    <style>
        #slider {
            margin: 0 auto;
            width: 800px;
            max-width: 100%;
            text-align: center;
        }

        #slider input[type=radio] {
            display: none;
        }

        #slider label {
            cursor: pointer;
            text-decoration: none;
        }

        #slides {
            padding: 10px;
            border: 3px solid #ccc;
            background: #fff;
            position: relative;
            z-index: 1;
        }

        #overflow {
            width: 100%;
            overflow: hidden;
        }

        #slide1:checked ~ #slides .inner {
            margin-left: 0;
        }

        #slide2:checked ~ #slides .inner {
            margin-left: -100%;
        }

        #slide3:checked ~ #slides .inner {
            margin-left: -200%;
        }

        #slide4:checked ~ #slides .inner {
            margin-left: -300%;
        }

        #slides .inner {
            transition: margin-left 800ms cubic-bezier(0.770, 0.000, 0.175, 1.000);
            width: 400%;
            line-height: 0;
            height: 300px;
        }

        #slides .slide {
            width: 25%;
            float: left;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            color: #fff;
        }

        #slides .slide_1 {
            background-image: url("https://v1.nitrocdn.com/LHbHSQjuJUFRmJJLlNyuGQWqggDsJOZh/assets/static/optimized/rev-e543e9d/wp-content/uploads/2018/08/best-schools-in-Central-London-850x565.jpg");
        }

        #slides .slide_2 {
            background-image: url("https://ec.europa.eu/esf/BlobServlet?mode=displayPicture&photoId=11828");
        }

        #slides .slide_3 {
            background-image: url("https://www.ctvnews.ca/polopoly_fs/1.5257857.1610051479!/httpImage/image.jpg_gen/derivatives/landscape_1020/image.jpg");
        }

        #slides .slide_4 {
            background-image: url("https://d7rh5s3nxmpy4.cloudfront.net/CMP1431/1/LHIL153BI25430_USA_000041_Roosevelt_High_School_IMD.JPG");
        }

        #controls {
            margin: -180px 0 0 0;
            width: 100%;
            height: 50px;
            z-index: 3;
            position: relative;
        }

        #controls label {
            transition: opacity 0.2s ease-out;
            display: none;
            width: 50px;
            height: 50px;
            opacity: .4;
        }

        #controls label:hover {
            opacity: 1;
        }

        #slide1:checked ~ #controls label:nth-child(2),
        #slide2:checked ~ #controls label:nth-child(3),
        #slide3:checked ~ #controls label:nth-child(4),
        #slide4:checked ~ #controls label:nth-child(1) {
            background: url(https://image.flaticon.com/icons/svg/130/130884.svg) no-repeat;
            float: right;
            margin: 0 -50px 0 0;
            display: block;
        }

        #slide1:checked ~ #controls label:nth-last-child(2),
        #slide2:checked ~ #controls label:nth-last-child(3),
        #slide3:checked ~ #controls label:nth-last-child(4),
        #slide4:checked ~ #controls label:nth-last-child(1) {
            background: url(https://image.flaticon.com/icons/svg/130/130882.svg) no-repeat;
            float: left;
            margin: 0 0 0 -50px;
            display: block;
        }

        #bullets {
            margin: 150px 0 0;
            text-align: center;
        }

        #bullets label {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 100%;
            background: #ccc;
            margin: 0 10px;
        }

        #slide1:checked ~ #bullets label:nth-child(1),
        #slide2:checked ~ #bullets label:nth-child(2),
        #slide3:checked ~ #bullets label:nth-child(3),
        #slide4:checked ~ #bullets label:nth-child(4) {
            background: #444;
        }

        @media screen and (max-width: 900px) {
            #slide1:checked ~ #controls label:nth-child(2),
            #slide2:checked ~ #controls label:nth-child(3),
            #slide3:checked ~ #controls label:nth-child(4),
            #slide4:checked ~ #controls label:nth-child(1),
            #slide1:checked ~ #controls label:nth-last-child(2),
            #slide2:checked ~ #controls label:nth-last-child(3),
            #slide3:checked ~ #controls label:nth-last-child(4),
            #slide4:checked ~ #controls label:nth-last-child(1) {
                margin: 0;
            }

            #slides {
                max-width: calc(100% - 140px);
                margin: 0 auto;
            }
        }
    </style>
    <div id="slider">
        <input type="radio" name="slider" id="slide1" checked>
        <input type="radio" name="slider" id="slide2">
        <input type="radio" name="slider" id="slide3">
        <input type="radio" name="slider" id="slide4">
        <div id="slides">
            <div id="overflow">
                <div class="inner">
                    <div class="slide slide_1">
                        <div class="slide-content">
                        </div>
                    </div>
                    <div class="slide slide_2">
                        <div class="slide-content">
                        </div>
                    </div>
                    <div class="slide slide_3">
                        <div class="slide-content">
                        </div>
                    </div>
                    <div class="slide slide_4">
                        <div class="slide-content">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="controls">
            <label for="slide1"></label>
            <label for="slide2"></label>
            <label for="slide3"></label>
            <label for="slide4"></label>
        </div>
        <div id="bullets">
            <label for="slide1"></label>
            <label for="slide2"></label>
            <label for="slide3"></label>
            <label for="slide4"></label>
        </div>
    </div>
    <div class="w-full max-w-xs mx-auto">
        <form method="POST" action="{{ route('login') }}" class="bg-white shadow rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="emailaddress">
                    Adresse Email
                </label>
                <input
                    class="shadow appearance-none border @error('password') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                    type="email" name="email" id="emailaddress" placeholder="email@example.com">
                @error('email')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Mot de Passe
                </label>
                <input
                    class="shadow appearance-none border @error('password') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                    type="password" name="password" id="password" placeholder="******************">
                @error('password')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label class="block text-gray-500 font-bold">
                    <input class="mr-2 leading-tight" type="checkbox"
                           name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span class="text-sm">
                    Rappelez-moi
                </span>
                </label>
            </div>
            <div class="flex items-center justify-between">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                    Connexion
                </button>
            </div>
        </form>
    </div>

    <style>
        #fcf-form {
            display:block;
        }

        .fcf-body {
            margin: 0;
            font-family: -apple-system, Arial, sans-serif;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #fff;
            padding: 30px;
            padding-bottom: 10px;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            max-width: 100%;
        }

        .fcf-form-group {
            margin-bottom: 1rem;
        }

        .fcf-input-group {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            -ms-flex-align: stretch;
            align-items: stretch;
            width: 100%;
        }

        .fcf-form-control {
            display: block;
            width: 100%;
            height: calc(1.5em + 0.75rem + 2px);
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            outline: none;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .fcf-form-control:focus {
            border: 1px solid #313131;
        }

        select.fcf-form-control[size], select.fcf-form-control[multiple] {
            height: auto;
        }

        textarea.fcf-form-control {
            font-family: -apple-system, Arial, sans-serif;
            height: auto;
        }

        label.fcf-label {
            display: inline-block;
            margin-bottom: 0.5rem;
        }

        .fcf-credit {
            padding-top: 10px;
            font-size: 0.9rem;
            color: #545b62;
        }

        .fcf-credit a {
            color: #545b62;
            text-decoration: underline;
        }

        .fcf-credit a:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        .fcf-btn {
            display: inline-block;
            font-weight: 400;
            color: #212529;
            text-align: center;
            vertical-align: middle;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        @media (prefers-reduced-motion: reduce) {
            .fcf-btn {
                transition: none;
            }
        }

        .fcf-btn:hover {
            color: #212529;
            text-decoration: none;
        }

        .fcf-btn:focus, .fcf-btn.focus {
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .fcf-btn-primary {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }

        .fcf-btn-primary:hover {
            color: #fff;
            background-color: #0069d9;
            border-color: #0062cc;
        }

        .fcf-btn-primary:focus, .fcf-btn-primary.focus {
            color: #fff;
            background-color: #0069d9;
            border-color: #0062cc;
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.5);
        }

        .fcf-btn-lg, .fcf-btn-group-lg>.fcf-btn {
            padding: 0.5rem 1rem;
            font-size: 1.25rem;
            line-height: 1.5;
            border-radius: 0.3rem;
        }

        .fcf-btn-block {
            display: block;
            width: 100%;
        }

        .fcf-btn-block+.fcf-btn-block {
            margin-top: 0.5rem;
        }

        input[type="submit"].fcf-btn-block, input[type="reset"].fcf-btn-block, input[type="button"].fcf-btn-block {
            width: 100%;
        }
    </style>
    <div class="fcf-body">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div id="fcf-form">
            <h3 class="fcf-h3"><strong>Contact Administrateur et demande inscription</strong></h3>

            <form id="fcf-form-id" class="fcf-form-class" method="post" action="{{route('contact.admin')}}">
                @csrf
                <div class="fcf-form-group">
                    <label for="Name" class="fcf-label">Votre nom</label>
                    <div class="fcf-input-group">
                        <input type="text" id="Name" name="name" class="fcf-form-control" required>
                    </div>
                </div>

                <div class="fcf-form-group">
                    <label for="Email" class="fcf-label">Votre adresse email</label>
                    <div class="fcf-input-group">
                        <input type="email" id="Email" name="email" class="fcf-form-control" required>
                    </div>
                </div>

                <div class="fcf-form-group">
                    <label for="Message" class="fcf-label">Votre message</label>
                    <div class="fcf-input-group">
                        <textarea id="Message" name="message" class="fcf-form-control" rows="6" maxlength="3000" required></textarea>
                    </div>
                </div>

                <div class="fcf-form-group">
                    <button type="submit" id="fcf-button" class="fcf-btn fcf-btn-primary fcf-btn-lg fcf-btn-block">Envoyer Message</button>
                </div>


            </form>
        </div>

    </div>

@endsection
