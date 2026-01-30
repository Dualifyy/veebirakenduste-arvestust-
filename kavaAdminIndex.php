<?php
require('2conf.php');

require('kavaFunktsioon.php');

require('nav.php');

if(isset($_REQUEST['kustuta'])){
    kustutaSyndmus($_REQUEST['kustuta']);
    header("Location: ". $_SERVER['PHP_SELF']);
    exit();
}
if(!empty($_REQUEST['syndmus'])){
    lisaSyndmus($_REQUEST['syndmus'], $_REQUEST['kellaaeg']);
    header("Location: ". $_SERVER['PHP_SELF']);
    exit();
}
?>


<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="terveStyle.css">
    <link rel="stylesheet" href="background.css">
    <meta charset="UTF-8">
    <title>Peoõhtu</title>

</head>
<body>
<div class="wrapper" id="wrapper"></div>
<h2>Sündmustekava</h2>
<br>
<table>
    <tr>
        <th>Sündmus</th>
        <th>Kellaaeg</th>
        <th>Kustuta</th>
    </tr>
    <?php
    kuvaSyndmuseid();
    ?>
</table>
<br>
<form action="?" method="post">
<h2>Lisa sündmus</h2>
    <label>Sündmus</label><br>
<input type="text" name="syndmus" placeholder="Sündmus"> <br> <br>

    <label>Kellaaeg</label><br>
<input type="text" name="kellaaeg" placeholder="Kellaaeg"> <br> <br>

    <input type="submit" value="Lisa sündmus">
</form>

<script>
    const colorSchemes = {
        blue: ['#001F3F', '#003366', '#004C99', '#0066CC', '#0080FF', '#3399FF'],
        green: ['#004D1A', '#006622', '#008033', '#009933', '#00B33C', '#00CC44'],
        purple: ['#2A0033', '#3F004D', '#530066', '#660080', '#7A0099', '#8F00B3'],
        red: ['#330000', '#660000', '#990000', '#CC0000', '#FF0000', '#FF3333'],
        teal: ['#003333', '#004D4D', '#006666', '#008080', '#009999', '#00B3B3'],
        orange: ['#331100', '#662200', '#993300', '#CC4400', '#FF5500', '#FF7733'],
        pink: ['#330033', '#4D004D', '#660066', '#800080', '#990099', '#B300B3'],
        yellow: ['#332600', '#664D00', '#997300', '#CC9900', '#FFBF00', '#FFD633']
    };

    const columns = Object.keys(colorSchemes);

    function createColumns() {
        const wrapper = document.getElementById('wrapper');
        wrapper.innerHTML = '';

        columns.forEach(columnColor => {
            const column = document.createElement('div');
            column.className = 'column';
            column.dataset.colorScheme = columnColor;

            const boxCount = Math.ceil(window.innerHeight / 16);
            for (let i = 0; i < boxCount; i++) {
                const box = document.createElement('div');
                box.className = 'box';
                column.appendChild(box);
            }

            wrapper.appendChild(column);
        });
    }

    function initializeColumns() {
        document.querySelectorAll('.column').forEach(column => {
            const scheme = colorSchemes[column.dataset.colorScheme];
            column.querySelectorAll('.box').forEach((box, i) => {
                box.style.backgroundColor = scheme[i % scheme.length];
            });
        });
    }

    function animateColumn(column, direction = 1) {
        const boxes = [...column.children];
        const scheme = colorSchemes[column.dataset.colorScheme];
        const colors = boxes.map(b => b.style.backgroundColor || scheme[0]);

        direction > 0 ? colors.unshift(colors.pop()) : colors.push(colors.shift());
        boxes.forEach((b, i) => b.style.backgroundColor = colors[i]);
    }

    createColumns();
    initializeColumns();

    document.querySelectorAll('.column').forEach((col, i) => {
        setInterval(() => animateColumn(col, i % 2 ? -1 : 1), 200);
    });

    window.addEventListener('resize', () => {
        createColumns();
        initializeColumns();
    });
</script>
</body>