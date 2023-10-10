<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://www.marcoguglie.it/Codepen/AnimatedHeaderBg/demo-1/js/EasePack.min.js"></script>
    <script src="https://www.marcoguglie.it/Codepen/AnimatedHeaderBg/demo-1/js/rAF.js"></script>
    <script src="https://www.marcoguglie.it/Codepen/AnimatedHeaderBg/demo-1/js/TweenLite.min.js"></script>
    @vite('resources/css/app.css')
    <title>Cosmos Odyssey</title>   
</head>
<body class="bg-black">
<div id="large-header" class="large-header">
<canvas id="demo-canvas"></canvas>
<div class="main-title">
<nav class="flex justify-between mb-4 p-2 bg-gray-900 text-white">
        <div>
        <img style="cursor: pointer" onclick="location.href='{{ route('routes') }}'" src="{{ asset('logo.png') }}" width="95">
        </div>
        @auth
        <div>
            You are logged in as {{ auth()->user()->name }}
        </div>
        @endauth
        <div class="flex flex-col justify-center">
    <div class="bg-gray-900 flex items-center justify-center">
    <div class="relative inline-block text-left dropdown">
        <span class="rounded-md shadow-sm"
        ><button class="inline-flex justify-center px-2 py-1 text-sm font-medium leading- transition duration-150 ease-in-out hover:text-gray-500 focus:outline-none focus:shadow-outline-blue " 
        type="button" aria-haspopup="true" aria-expanded="true" aria-controls="headlessui-menu-items-117"> 
        <svg onclick="" style="cursor: pointer" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
         <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
        </button
        ></span>
        <div class="opacity-0 invisible dropdown-menu transition-all duration-300 transform origin-top-right -translate-y-2 scale-95">
        <div class="bg-gray-800 absolute right-0 w-56 mt-4 origin-top-right rounded-md shadow-lg outline-none" aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117" role="menu">
        <form action="{{ route('reserve.show') }}" method="get"> 
        <div class=" px-4 py-3">         
            <p class="mb-2 flex justify-start cursor-default text-sm font-medium leading-5 text-white truncate">Enter reservation number</p>
            <input type="text" name="bookingnr" class="peer block w-full appearance-none border-0 border-b border-gray-500 bg-transparent pt-2 px-0 text-sm text-white" placeholder="Your reservation number" />
            </div>
            <div class="py-1">
            <button class="text-white hover:text-gray-300 flex justify-start w-full px-4 pb-1 text-sm leading-5 text-left"  >Find</button>  
        </div>
        </form>
        @guest
        <div style="cursor: pointer" onclick="location.href='{{ route('login.show') }}'" class="border-t p-4 border-white text-white hover:text-gray-300 flex justify-start w-full text-sm leading-5 text-left">
            Login
        </div>
        @endguest
        @auth
        <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="border-t p-2 border-white text-white hover:text-gray-300 flex justify-start w-full text-sm leading-5 text-left">
        Logout
        </button>
        @endauth
        </div>  
    </div> 
    </div>              
    </div>
 </nav>

    @yield('content')
</div>
    <script>
        $( document ).ready(function() {
        $.ajax({
        type: "GET",
        url: "{{ route('update') }}",
        success: function(data) {
             console.log(data);
         },
        });
        });
        setInterval(function(){
        $( document ).ready(function() {
        $.ajax({
        type: "GET",
        url: "{{ route('update') }}",
        success: function(data) {
             console.log(data);
         },
        });
        });
            },60000);

        
    </script>
 <script>
    (function() {

var width, height, largeHeader, canvas, ctx, points, target, animateHeader = true;

// Main
initHeader();
initAnimation();
addListeners();

function initHeader() {
    width = window.innerWidth;
    height = window.innerHeight;
    target = {x: width/2, y: height/2};

    largeHeader = document.getElementById('large-header');
    largeHeader.style.height = height+'px';

    canvas = document.getElementById('demo-canvas');
    canvas.width = width;
    canvas.height = height;
    ctx = canvas.getContext('2d');

    // create points
    points = [];
    for(var x = 0; x < width; x = x + width/20) {
        for(var y = 0; y < height; y = y + height/20) {
            var px = x + Math.random()*width/20;
            var py = y + Math.random()*height/20;
            var p = {x: px, originX: px, y: py, originY: py };
            points.push(p);
        }
    }

    // for each point find the 5 closest points
    for(var i = 0; i < points.length; i++) {
        var closest = [];
        var p1 = points[i];
        for(var j = 0; j < points.length; j++) {
            var p2 = points[j]
            if(!(p1 == p2)) {
                var placed = false;
                for(var k = 0; k < 5; k++) {
                    if(!placed) {
                        if(closest[k] == undefined) {
                            closest[k] = p2;
                            placed = true;
                        }
                    }
                }

                for(var k = 0; k < 5; k++) {
                    if(!placed) {
                        if(getDistance(p1, p2) < getDistance(p1, closest[k])) {
                            closest[k] = p2;
                            placed = true;
                        }
                    }
                }
            }
        }
        p1.closest = closest;
    }

    // assign a circle to each point
    for(var i in points) {
        var c = new Circle(points[i], 2+Math.random()*2, 'rgba(255,255,255,0.3)');
        points[i].circle = c;
    }
}

// Event handling
function addListeners() {
    if(!('ontouchstart' in window)) {
        window.addEventListener('mousemove', mouseMove);
    }
    window.addEventListener('scroll', scrollCheck);
    window.addEventListener('resize', resize);
}

function mouseMove(e) {
    var posx = posy = 0;
    if (e.pageX || e.pageY) {
        posx = e.pageX;
        posy = e.pageY;
    }
    else if (e.clientX || e.clientY)    {
        posx = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
        posy = e.clientY + document.body.scrollTop + document.documentElement.scrollTop;
    }
    target.x = posx;
    target.y = posy;
}

function scrollCheck() {
    if(document.body.scrollTop > height) animateHeader = false;
    else animateHeader = true;
}

function resize() {
    width = window.innerWidth;
    height = window.innerHeight;
    largeHeader.style.height = height+'px';
    canvas.width = width;
    canvas.height = height;
}

// animation
function initAnimation() {
    animate();
    for(var i in points) {
        shiftPoint(points[i]);
    }
}

function animate() {
    if(animateHeader) {
        ctx.clearRect(0,0,width,height);
        for(var i in points) {
            // detect points in range
            if(Math.abs(getDistance(target, points[i])) < 4000) {
                points[i].active = 0.3;
                points[i].circle.active = 0.6;
            } else if(Math.abs(getDistance(target, points[i])) < 20000) {
                points[i].active = 0.1;
                points[i].circle.active = 0.3;
            } else if(Math.abs(getDistance(target, points[i])) < 40000) {
                points[i].active = 0.02;
                points[i].circle.active = 0.1;
            } else {
                points[i].active = 0;
                points[i].circle.active = 0;
            }

            drawLines(points[i]);
            points[i].circle.draw();
        }
    }
    requestAnimationFrame(animate);
}

function shiftPoint(p) {
    TweenLite.to(p, 1+1*Math.random(), {x:p.originX-50+Math.random()*100,
        y: p.originY-50+Math.random()*100, ease:Circ.easeInOut,
        onComplete: function() {
            shiftPoint(p);
        }});
}

// Canvas manipulation
function drawLines(p) {
    if(!p.active) return;
    for(var i in p.closest) {
        ctx.beginPath();
        ctx.moveTo(p.x, p.y);
        ctx.lineTo(p.closest[i].x, p.closest[i].y);
        ctx.strokeStyle = 'rgba(156,217,249,'+ p.active+')';
        ctx.stroke();
    }
}

function Circle(pos,rad,color) {
    var _this = this;

    // constructor
    (function() {
        _this.pos = pos || null;
        _this.radius = rad || null;
        _this.color = color || null;
    })();

    this.draw = function() {
        if(!_this.active) return;
        ctx.beginPath();
        ctx.arc(_this.pos.x, _this.pos.y, _this.radius, 0, 2 * Math.PI, false);
        ctx.fillStyle = 'rgba(156,217,249,'+ _this.active+')';
        ctx.fill();
    };
}

// Util
function getDistance(p1, p2) {
    return Math.pow(p1.x - p2.x, 2) + Math.pow(p1.y - p2.y, 2);
}

})();
 </script>