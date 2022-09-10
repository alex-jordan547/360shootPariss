const videos = document.getElementsByClassName("vid");

for (let i = 0; i < videos.length; i++) {
    if (i === 1 || i === 5 || i === 6) {
        videos[i].volume = 0.5;
    } else {
        videos[i].volume = 0.05;
    }
}
