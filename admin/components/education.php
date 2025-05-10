<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College of Education</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


</head>

<body>
    <iframe src="http://localhost/ECADYB/admin/flipbook/turn.js/dist/index.html#page/1" width="100%" height="650px"
        style="border: none;">
    </iframe>

    <script src="https://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.9.1/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.4.0/backbone-min.js"></script>
    <script src="./script.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const elements = document.querySelectorAll('.catalog-app, #viewer, #flipbook');

        elements.forEach(el => {
            el.addEventListener('mousedown', function(e) {
                const startX = e.clientX;
                const startY = e.clientY;
                const startWidth = parseInt(document.defaultView.getComputedStyle(el).width,
                    10);
                const startHeight = parseInt(document.defaultView.getComputedStyle(el)
                    .height,
                    10);

                function doDrag(e) {
                    el.style.width = startWidth + e.clientX - startX + 'px';
                    el.style.height = startHeight + e.clientY - startY + 'px';
                }

                function stopDrag() {
                    window.removeEventListener('mousemove', doDrag);
                    window.removeEventListener('mouseup', stopDrag);
                }

                window.addEventListener('mousemove', doDrag);
                window.addEventListener('mouseup', stopDrag);
            });
        });
    });
    </script>

</body>

</html>