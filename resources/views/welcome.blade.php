<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            .container {
                position: relative; /* Позиционирование контейнера */
            }

            .dot {
                width: 10px;
                height: 10px;
                margin: 5px;
                border-radius: 50%;
                display: inline-block; /* Отображение точек как блоков */
            }

            .area {
                position: absolute; /* Позиционирование области */
                top: 0;
                left: 0;
                width: 0;
                height: 0;
                pointer-events: none; /* Сделать область некликабельной */
            }

            .red-area {
                background-color: red;
            }

            .green-area {
                background-color: green;
            }
        </style>
    </head>
    <body class="antialiased">
    <div class="container">
        <span class="dot" style="background-color: red;"></span>
        <span class="dot" style="background-color: red;"></span>
        <span class="dot" style="background-color: red;"></span>

        <span class="dot" style="background-color: green;"></span>
        <span class="dot" style="background-color: green;"></span>
        <span class="dot" style="background-color: green;"></span>
    </div>

    <script>
        const dots = document.querySelectorAll('.dot');
        const container = document.querySelector('.container');

        let redArea = new Area('red-area');
        let greenArea = new Area('green-area');

        function Area(className) {
            this.element = document.createElement('div');
            this.element.classList.add('area', className);
            container.appendChild(this.element);
        }

        function updateAreas() {
            let redX = 0;
            let redY = 0;
            let greenX = 0;
            let greenY = 0;

            dots.forEach(dot => {
                const color = dot.style.backgroundColor;
                const x = dot.offsetLeft;
                const y = dot.offsetTop;

                if (color === 'red') {
                    redX += x;
                    redY += y;
                } else if (color === 'green') {
                    greenX += x;
                    greenY += y;
                }
            });

            redArea.element.style.left = `${redX / dots.length}px`;
            redArea.element.style.top = `${redY / dots.length}px`;
            redArea.element.style.width = `${Math.max(...dots.map(dot => dot.offsetLeft + dot.offsetWidth)) - redX / dots.length}px`;
            redArea.element.style.height = `${Math.max(...dots.map(dot => dot.offsetTop + dot.offsetHeight)) - redY / dots.length}px`;

            greenArea.element.style.left = `${greenX / dots.length}px`;
            greenArea.element.style.top = `${greenY / dots.length}px`;
            greenArea.element.style.width = `${Math.max(...dots.map(dot => dot.offsetLeft + dot.offsetWidth)) - greenX / dots.length}px`;
            greenArea.element.style.height = `${Math.max(...dots.map(dot => dot.offsetTop + dot.offsetHeight)) - greenY / dots.length}px`;
        }

        window.addEventListener('load', updateAreas);
        window.addEventListener('resize', updateAreas);
    </script>
    </body>
</html>
