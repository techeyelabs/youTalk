<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

    <style>
        
    </style>


@yield('custom_css')

<head>
    
</head>
<body>

    <div style="text-align:left;">
        <div style="display: inline-block; text-align:left;">    
            @yield('content')

            <div>

            </div>

            <footer style="text-align: left;">
            ----------------------------------------------------------<br/>
            https://YouTalk.tel
            </footer>
        </div>

        
    </div>      
    @yield('custom_js')
</body>
</html>
