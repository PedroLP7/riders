<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Menu</title>
    @vite(['resources/css/app.scss', 'resources/js/app.js'])

</head>
<body>
    <div id="editMenu" data-id="{{$idMenu}}">  </div>

    <style>
        #editMenu {
            display: flex;
            justify-content: center;
            height: 100vh;
        }
    </style>
</body>
</html>
