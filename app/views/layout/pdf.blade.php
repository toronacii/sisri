<!DOCTYPE html>
<html>
<head>

    @section('css_js')

    {{HTML::style('css/pdf.css')}}
    
    @show
</head>
<body>
    <div id="container">
        @yield('content')
    </div>
</body>
</html>