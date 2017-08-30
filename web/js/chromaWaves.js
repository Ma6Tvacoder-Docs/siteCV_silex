/*--------------------
SETTINGS
--------------------*/
let settings = {
    amplitudeX: 100,
    amplitudeY: 20,
    lines: 20,
    hueStartColor: 53,
    saturationStartColor: 74,
    lightnessStartColor: 67,
    hueEndColor: 216,
    saturationEndColor: 100,
    lightnessEndColor: 7,
    smoothness: 3,
    offsetX: 10,
    fill: true,
    crazyness: false
}


/*--------------------
VARS
--------------------*/
let svg = document.getElementById('svg'),
    winW = window.innerWidth,
    // winH = window.innerHeight,
    winH = document.getElementById('bumper').clientHeight,
    Colors = [],
    Paths = [],
    Mouse = {
        x: winW / 2,
        y: winH / 2
    },
    overflow,
    startColor,
    endColor,
    gui;


/*--------------------
PATH
--------------------*/
class Path {
    constructor (y, fill, offsetX) {
        this.rootY = y;
        this.fill = fill;
        this.offsetX = offsetX;
    };

    createRoot() {
        this.root = [];
        let offsetX = this.offsetX;
        // console.log(offsetX)
        let x = -overflow + offsetX;
        let y = 0;
        let rootY = this.rootY;
        let upSideDown = 0;

        this.root.push({ x: x, y: rootY});

        while (x < winW) {
            let value = Math.random() > 0.5 ? 1 : -1;

            // Crazyness
            if (settings.crazyness) {
                x += parseInt((Math.random() * settings.amplitudeX / 2) + (settings.amplitudeX / 2));
                y = (parseInt((Math.random() * settings.amplitudeY / 2) + (settings.amplitudeY / 2)) * value) + rootY;
            } else {
            // Geometric
                upSideDown = !upSideDown;
                value = (upSideDown == 0) ? 1 : -1;

                x += settings.amplitudeX;
                y = settings.amplitudeY * value + rootY;
            }

            this.root.push({ x: x, y: y});
        };

        this.root.push({ x: winW + overflow, y: rootY});
    };

    createCircles() {
        const fill = '#fff';
        this.root.forEach(function(key, obj) {
            const circle = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
            circle.setAttribute('r', 1);
            circle.setAttribute('cx', key.x);
            circle.setAttribute('cy', key.y);
            circle.setAttribute('fill', 'rgba(255, 255, 255, .3)');
            svg.appendChild(circle);
        })
    };

    createPath(){
        const root = this.root;
        const fill = this.fill;
        const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
        path.setAttribute('fill', fill);
        path.setAttribute('stroke', fill);
        svg.appendChild(path);
        if (settings.fill) {
          svg.setAttribute('class','path');
        } else {
          svg.setAttribute('class','stroke');
        }

        // first & second points
        let d = `M -${overflow} ${winH + overflow}`;
        d += ` L ${root[0].x} ${root[0].y}`;

        // magic points
        for (let i = 1; i < this.root.length - 1; i++) {
            let prevPoint = root[i - 1];
            let actualPoint = root[i];
            let diffX = (actualPoint.x - prevPoint.x) / settings.smoothness;
            let x1 = prevPoint.x + diffX;
            let x2 = actualPoint.x - diffX;
            let x = actualPoint.x;
            let y1 = prevPoint.y;
            let y2 = actualPoint.y;
            let y = actualPoint.y;

            d += ` C ${x1} ${y1}, ${x2} ${y2}, ${x} ${y}`;
        }

        // Second last
        const reverseRoot = root.reverse();
        d += ` L ${reverseRoot[0].x} ${reverseRoot[0].y}`;
        root.reverse();

        // Last point
        d += ` L ${winW + overflow} ${winH + overflow}`;

        // Close path
        d += ` Z`;

        path.setAttribute('d', d);
    };

    createLines(){
        const root = this.root;
        const fill = this.fill;
        const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
        path.setAttribute('fill', fill);
        path.classList.add('path');
        svg.appendChild(path);

        // first & second points
        let d = `M -${overflow} ${winH + overflow}`;
        d += ` L ${root[0].x} ${root[0].y}`;

        // Magic points
        for (let i = 1; i < root.length - 1; i++) {
            d += ` L ${root[i].x} ${root[i].y}`;
        }

        // Second last & last points
        const reverseRoot = root.reverse();
        d += ` L ${reverseRoot[0].x} ${reverseRoot[0].y}`;
        d += ` L ${winW + overflow} ${winH + overflow}`;
        root.reverse();

        // Close path
        d += ` Z`;

        path.setAttribute('d', d);
    };
};


/*--------------------
INIT
--------------------*/
function init(){
    // Overflow
    overflow = Math.abs(settings.lines * settings.offsetX);

    // Colors
    startColor = `hsl(${settings.hueStartColor}, ${settings.saturationStartColor}%, ${settings.lightnessStartColor}%)`;
    endColor = `hsl(${settings.hueEndColor}, ${settings.saturationEndColor}%, ${settings.lightnessEndColor}%)`;
    Colors = chroma.scale([startColor, endColor]).mode('lch').colors(settings.lines + 2);

    // Reset
    Paths = [];
    var parent = document.getElementById('svg').parentElement
    parent.removeChild(svg);

    svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
    svg.setAttribute('id', 'svg');
    parent.insertBefore(svg, parent.children[0]);

    // Background
    // if (settings.fill) {
    //     svg.style.backgroundColor = Colors[0];
    // } else {
    //     svg.style.backgroundColor = '#000';
    // }

    // Lines
    for (let i = 0; i < settings.lines + 1; i++) {
        let rootY = parseInt(winH / settings.lines * i);
        const path = new Path(rootY, Colors[i + 1], settings.offsetX * i);
        Paths.push(path);
        path.createRoot();
    }
    Paths.forEach(function(path) {
        path.createPath();
    });
};
init();


/*--------------------
WIN RESIZE
--------------------*/
window.addEventListener('resize', function() {
    winW = window.innerWidth;
    winH = document.getElementById('bumper').clientHeight;
    console.log( document.getElementById('bumper').clientHeight )
    init();
});


/*--------------------
DAT GUI
--------------------*/
function datgui(){
    gui = new dat.GUI();

    // Settings
    let guiSettings = gui.addFolder('Settings');
    guiSettings.add(settings, 'lines', 5, 50).step(1).onChange(init);
    guiSettings.add(settings, 'amplitudeX', 20, 300).step(1).onChange(init);
    guiSettings.add(settings, 'amplitudeY', 0, 200).step(1).onChange(init);
    guiSettings.add(settings, 'offsetX', -20, 20).step(1).onChange(init);
    guiSettings.add(settings, 'smoothness', 0.5, 10).step(0.2).onChange(init);
    guiSettings.add(settings, 'fill', false).onChange(init);
    guiSettings.add(settings, 'crazyness', false).onChange(init);
    guiSettings.open();

    // Start Color
    let guiStartColor = gui.addFolder('Start Color');
    guiStartColor.add(settings, 'hueStartColor', 0, 360).step(1).onChange(init);
    guiStartColor.add(settings, 'saturationStartColor', 0, 100).step(1).onChange(init);
    guiStartColor.add(settings, 'lightnessStartColor', 0, 100).step(1).onChange(init);
    guiStartColor.open();

    // End Color
    let guiEndColor = gui.addFolder('End Color');
    guiEndColor.add(settings, 'hueEndColor', 0, 360).step(1).onChange(init);
    guiEndColor.add(settings, 'saturationEndColor', 0, 100).step(1).onChange(init);
    guiEndColor.add(settings, 'lightnessEndColor', 0, 100).step(1).onChange(init);
    guiEndColor.open();

    // Randomize
    let guiRandomize = { randomize:function(){ randomize() }};
    gui.add(guiRandomize,'randomize');

    return gui;
}
datgui();


/*--------------------
RANDOMIZE
--------------------*/
function randomize(){
  var calc = parseInt(-20 + Math.random() * 40)
  if (calc <= 4 && calc >= -4){
    calc = 4
  }
  //console.log(calc)
  settings = {
      lines: parseInt(5 + Math.random() * 45),
      amplitudeX: parseInt(20 + Math.random()* 300),
      amplitudeY: parseInt(Math.random() * 55),
      hueStartColor: parseInt(Math.random() * 360),
      saturationStartColor: 74,
      lightnessStartColor: 67,
      hueEndColor: parseInt(Math.random() * 360),
      saturationEndColor: 90,
      lightnessEndColor: 14,
      smoothness: 1 + parseInt(Math.random() * 9),
      // offsetX: parseInt(-20 + Math.random() * 40),
      offsetX: calc,
      // fill: Math.random() * 1 > 0.3 ? true : false,
      fill: true,
      crazyness:  Math.random() * 1 > 0.9 ? true : false
  }
  init();
  gui.destroy();
  datgui();
}

randomize();

$('#bumper').click(function(e){
  randomize()
  var color = $(this).find('path').last().attr('fill')
  $(this).find('svg').attr('style', 'background-color:'+color+';')
})
