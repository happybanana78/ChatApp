<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="{{asset("css/style.css")}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script>
        tailwind.config = {
            theme: {
                screens: {
                sm: "480px",
                md: "768px",
                lg: "976px",
                xl: "1440px"
                },
                extend: {
                    colors: {
                        white: "white",
                        light: "#E2DFD2",
                        gold: "gold"
                    },
                },
            },
        }
    </script>
    <title>Chat App</title>
    @livewireStyles
</head>
<body id="body">
    <div>
        <a href="/"><img src="{{asset("images/logo.png")}}" alt="" width="150" height="150" class="absolute
        top-5 left-5"></a>
    </div>

    {{ $slot }}

    <script src="https://kit.fontawesome.com/dce035b76e.js" crossorigin="anonymous"></script>
    @livewireScripts
</body>
</html>