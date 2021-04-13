function updateFrameYoutube(event, videoId) {
  let frameYoutube = document.getElementById("frame-youtube");
  let url = frameYoutube.getAttribute("src");
  let parts = url.split("/");

  parts[parts.length - 1] = videoId;
  parts = parts.join("/");

  frameYoutube.setAttribute("src", parts);

  let playlistItems = document.getElementsByClassName("playlist-item");

  [].forEach.call(playlistItems, item => {
    item.classList.remove("active");
  });

  event.target.parentElement.parentElement.classList.add("active");
}
