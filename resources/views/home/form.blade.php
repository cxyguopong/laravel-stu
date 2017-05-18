<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

       
        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                font-size:14px;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: serif;
                line-height: 1.42857143;
                background:#eee;
            }

            .container {
                width:960px;
                min-height:450px;
                margin:100px auto;
                padding:10px 20px;
                border: 1px solid #DDD;
                border-radius: 2px;
                background:#FFF;
                box-shadow: 2px 4px 4px -4px rgba(0,0,0,.45);
            }

            .container > .content {
                margin-top:50px;
                border: 1px solid #ddd;
                padding: 10px 20px;
                border-radius: 10px;
                box-shadow: 2px 4px 4px rgba(0,0,0,.05);
            }

            .container > .content > .title {
                line-height: 35px;
                border-bottom: 1px solid #BBB;
                margin-bottom: 15px;
                text-align: center;
                font-family: "yahei";
                font-size: 16px;
                box-shadow:4px 8px 8px -8px rgba(0,0,0,.15);
            }

            .form {
                position: relative;
                margin:15px 0;
            }

            .form .form-error {
                position:absolute;
                top:0;
                right:0;
                max-width: 300px;
                border:1px solid;
                padding:10px;
                color:#f44336;
                background:#fbe4e2;
            }

            .form .form-error ul {
                margin:0;
                padding:0;
            }
            .form .form-error ul > li {
                list-style: none;
            }

            .form .item {
                margin-bottom:15px;
            }
            .form .item input:not([type]),
            .form .item input[type="text"],
            .form .item input[type="password"],
            .form .item input[type="number"]
            {
                padding:8px 10px;
                width:250px;
                border:1px solid #DDD;
            }

            .form .item label {
                float:left;
                display: inline-block;
                width:100px;
                overflow: hidden;
                white-space: nowrap;
                vertical-align: middle;
                text-align: right;
                margin-right:15px;
            }

            .form .item-btn {
                margin:20px 0;
                padding-left:115px;
            }

            .form .item-btn button,
            .form .item-btn input[type="button"],
            .form .item-btn input[type="submit"]{
                padding: 10px 20px;
                border: 1px solid #BBB;
                cursor: pointer;
                background: linear-gradient(to bottom,#FFF,#c7c6c6 50%, #FFF 95%);
                background: -webkit-linear-gradient(top,#FFF,#c7c6c6 50%, #FFF 95%);
            }

            .form .item-btn button:hover,
            .form .item-btn input[type="button"]:hover,
            .form .item-btn input[type="submit"]:hover {
                border-color:#999;
            }

            .form .item-btn button:active,
            .form .item-btn input[type="button"]:active,
            .form .item-btn input[type="submit"]:active,
            .form .item-btn button:focus,
            .form .item-btn input[type="button"]:focus,
            .form .item-btn input[type="submit"]:focus{
                outline:none;
                border-color:#999;
                box-shadow:1px 1px 1px 2px rgba(0,0,0,.05);
            }

            .form .item input:focus {
                border-color:#2196f3;
                outline:0;
            }

        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">this is form page!</div>

                <form action="/home/form" method="post" enctype="multipart/form-data" class="form">
                    <div class="form-error">
                        @if (count($errors) > 0)
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    {{ csrf_field() }}
                    <div class="item">
                        <label>username </label>
                        <input type="text" name="username" value="{{ old('username') }}">
                    </div>
                    <div class="item">
                        <label>password </label>
                        <input type="password" name="password">
                    </div>
                    <div class="item">
                        <label>age</label>
                        <input type="number" name="age" value="{{ old("age") }}">
                    </div>
                    <div class="item">
                        <label>photo</label>
                        <input type="file" name="photo">
                    </div>
                    <div class="item-btn">
                        <input type="submit" value="确认">
                    </div>
                </form>

                <a href="/home/response">to respone page !</a>
                
                <p>&#123;&#123;$approotkey&#125;&#125; {{$approotkey}}</p>

            </div>
        </div>
        <script src="/js/app.js"></script>
        <script>
        $(function(){
            var $form = $('form');    
            $form.submit(function(){
                var action = this.action;
                $.post(action, $form.serialize()).done(function(res){
                    console.log("res : ",res);    
                })
                .fail(function(res){
                    console.log('res:', res.responseJSON);
                })

                return false;
            })
        })
        </script>

    </body>
</html>
