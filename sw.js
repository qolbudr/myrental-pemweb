importScripts('https://storage.googleapis.com/workbox-cdn/releases/5.1.2/workbox-sw.js');

const CACHE_NAME = "TeachKid";

workbox.core.setCacheNameDetails({
    prefix: CACHE_NAME,
    // suffix: "v1",
    precache: "cache",
    runtime: "cache",
})

workbox.precaching.precacheAndRoute([
    {url: "assets/css/bootstrap.min.css", revision: null},
    {url: "assets/css/fontawesome-all.css", revision: null},
    {url: "assets/css/main.css", revision: null},
    {url: "assets/css/owl.carousel.min.css", revision: null},
    {url: "assets/css/owl.theme.default.min.css", revision: null},
    {url: "assets/data/games.json", revision: null},
    {url: "assets/data/quiz-berhitung.json", revision: null},
    {url: "assets/data/quiz-inggris.json", revision: null},
    {url: "assets/data/quiz-sains.json", revision: null},
    {url: "assets/data/quotes.json", revision: null},
    {url: "assets/img/about/ig.png", revision: null},
    {url: "assets/img/about/tele.png", revision: null},
    {url: "assets/img/about/wa.png", revision: null},
    {url: "assets/img/games/balapan.jpg", revision: null},
    {url: "assets/img/games/hewan.jpg", revision: null},
    {url: "assets/img/games/plastisin.jpg", revision: null},
    {url: "assets/img/games/sos.jpg", revision: null},
    {url: "assets/img/games/tictactoe.jpg", revision: null},
    {url: "assets/img/quiz/alam.jpg", revision: null},
    {url: "assets/img/quiz/berhitung.jpg", revision: null},
    {url: "assets/img/quiz/inggris.jpg", revision: null},
    {url: "assets/img/quiz/selamat.jpg", revision: null},
    {url: "assets/js/bootstrap.min.js", revision: null},
    {url: "assets/js/db.js", revision: null},
    {url: "assets/js/index.js", revision: null},
    {url: "assets/js/jquery-3.2.1.slim.min.js", revision: null},
    {url: "assets/js/owl.carousel.min.js", revision: null},
    {url: "assets/js/popper.min.js", revision: null},
    {url: "assets/js/script.js", revision: null},
    {url: "assets/js/sweetalert.min.js", revision: null},
    {url: "assets/page/about.html", revision: null},
    {url: "assets/page/games-content.html", revision: null},
    {url: "assets/page/games.html", revision: null},
    {url: "assets/page/hasil-quiz.html", revision: null},
    {url: "assets/page/home.html", revision: null},
    {url: "assets/page/quiz-berhitung.html", revision: null},
    {url: "assets/page/quiz-inggris.html", revision: null},
    {url: "assets/page/quiz-sains.html", revision: null},
    {url: "assets/page/quiz.html", revision: null},
    {url: "index.html", revision: null},
    {url: "sw.js", revision: null},
]);