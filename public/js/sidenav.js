var flag = false;
var hum = document.getElementsByClassName('hum-container');
var lgo = document.getElementsByClassName('img-holder');
var nav = document.getElementsByClassName('link-container')[0];
var nav_txt = document.getElementsByClassName('nav_txt');
var bar2 = document.getElementsByClassName('bar2')[0];
var links = document.getElementById('words');
var iconLink = document.getElementById('icons');
var ttleHolder = document.getElementsByClassName('title-holder');
var ttleHolder2 = document.getElementById('title-holder2');
var bar2 = document.getElementsByClassName('bar2')[0];
var barMid = document.getElementsByClassName('bar-mid')[0];
var bar3 = document.getElementsByClassName('bar3')[0];
var ic = document.getElementsByClassName('fa');
var main_container = document.getElementsByClassName('main-container')[0];
lgo[0].style.display = 'none';
ttleHolder[0].style.display = 'none';
words.style.display = 'none';
nav.style.width = '60px';

function easeInOut(val) {
    for (var i = 0; i < nav_txt.length; i++) {
        nav_txt[i].style.right = val;
        nav_txt[i].style.transition = .3 + "s";
    }
}
for (var i = 0; i < ic.length; i++) {
    ic[i].onmouseover = function() {
        this.style.transition = ".3s";
        this.style.transform = "scale(1.3)";
    }
    ic[i].onmouseleave = function() {
        this.style.transition = ".3s";
        this.style.transform = "scale(1)";
    }
}
nav.onmouseover = function() {
    easeInOut(0)
}
nav.onmouseleave = function() {
    easeInOut(100 + "%")
}

function toggle() {
    nav.style.transition = .5 + "s";
    if (!flag) {
        lgo[0].style.display = 'block';
        ttleHolder[0].style.display = 'block';
        nav.style.width = '200px';
        main_container.style.marginLeft = 215 + 'px';
        main_container.style.transition = ".3s";
        words.style.display = 'block';
        iconLink.style.display = 'none';
        bar2.style.margin = 3 + "px 0 0 0";
        barMid.style.margin = 3 + "px 0 0 0";
        bar3.style.margin = 3 + "px 0 0 0";
        hum[0].style.float = 'right';
        hum[0].style.marginRight = "10px";
        barMid.style.visibility = 'hidden';
        bar2.style.transform = "rotate(-45deg) ";
        bar2.style.transition = ".3s";
        bar3.style.transform = "rotate(45deg) translate(-8px, -8px)";
        bar3.style.transition = ".3s";
        flag = true;
    } else {
        lgo[0].style.display = 'none';
        ttleHolder[0].style.display = 'none';
        nav.style.width = '60px';
        main_container.style.marginLeft = 65 + 'px';
        words.style.display = 'none';
        iconLink.style.display = 'block';
        bar2.style.margin = "3px auto 0 auto";
        barMid.style.margin = "3px auto 0 auto";
        bar3.style.margin = "3px auto 0 auto";
        hum[0].style.float = 'none';
        hum[0].style.marginRight = "0";
        barMid.style.visibility = 'visible';
        bar2.style.transform = "rotate(0deg) ";
        bar3.style.transform = "rotate(0deg) translate(0)"
        flag = false;
    }
}

function upDown() {
    if (!flag) {
        bar2.style.transform = "rotate(-25deg)";
        bar2.style.transition = .4 + "s";
    } else {
        bar2.style.transform = "rotate(0)";
        bar3.style.transform = "rotate(0) translate(0)";
        barMid.style.visibility = "visible";
        bar2.style.transition = .4 + "s";
    }
}

function leave() {
    if (!flag) bar2.style.transform = "rotate(0deg)";
    else {
        bar2.style.transform = "rotate(-45deg) ";
        bar3.style.transform = "rotate(45deg) translate(-8px, -8px)";
        barMid.style.visibility = "hidden";
    }
}
hum[0].addEventListener('mouseleave', leave);
hum[0].addEventListener('mouseover', upDown);
hum[0].addEventListener('click', toggle);