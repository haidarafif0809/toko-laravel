var min_id = null;
var hour_id = null;
!(function(d, w) {
    calculateTime();
    getMinutes();
    getHours();
    setInterval(calculateTime, 1000);
})(document, window);

function calculateTime() {
    $(".seconds .to").addClass("hide").removeClass("to").addClass("from").removeClass("hide").addClass("n").find("span:not(.shadow)").each(function(i, el) {
        $(el).text(getSeconds());
    });
    $(".seconds .from:not(.n)").addClass("hide").addClass("to").removeClass("from").removeClass("hide").find("span:not(.shadow)").each(function(i, el) {
        $(el).text(getSeconds());
    });
    $(".seconds .n").removeClass("n");
}

function getHours() {
    var hour = new Date().getHours();
    hour = hour < 10 ? "0" + hour : hour;
    $(".hours .to").addClass("hide").removeClass("to").addClass("from").removeClass("hide").addClass("n").find("span:not(.shadow)").each(function(i, el) {
        $(el).text(hour);
    });
    $(".hours .from:not(.n)").addClass("hide").addClass("to").removeClass("from").removeClass("hide").find("span:not(.shadow)").each(function(i, el) {
        $(el).text(hour);
    });
    $(".hours .n").removeClass("n");
    window.clearTimeout(hour_id);
}

function getMinutes() {
    var min = new Date().getMinutes();
    min = min < 10 ? "0" + min : min;
    $(".minutes .to").addClass("hide").removeClass("to").addClass("from").removeClass("hide").addClass("n").find("span:not(.shadow)").each(function(i, el) {
        $(el).text(min);
    });
    $(".minutes .from:not(.n)").addClass("hide").addClass("to").removeClass("from").removeClass("hide").find("span:not(.shadow)").each(function(i, el) {
        $(el).text(min);
    });
    $(".minutes .n").removeClass("n");
    window.clearTimeout(min_id);
    if (parseInt(min) === 0 && parseInt(getSeconds()) === 0) {
        hour_id = window.setTimeout(getHours, 1000);
    }
}

function getSeconds() {
    var sec = new Date().getSeconds();
    if (parseInt(sec) >= 59) {
        min_id = window.setTimeout(getMinutes, 1000);
    }
    return sec < 10 ? "0" + sec : sec;
}