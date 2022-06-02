<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('title')</title>

    @stack('prepend-style')
    @include('includes.style')
    @stack('addon-style')
    
  </head>
  
    <livewire:styles/>
    <livewire:scripts/>

</head>
<body>
    <div id="app">
        
        <livewire:navbar/>

        <main class="py-4">
        @yield('content')
        @include('includes.footer')    

        @stack('prepend-script')
        @include('includes.script')
        @stack('addon-script')
        </main>
        
        
    </div>
</body>
</html>
