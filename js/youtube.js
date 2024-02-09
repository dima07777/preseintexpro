function loadVideo() {
    var videoLink = document.getElementById('video-link').value;
    var videoId = getVideoId(videoLink);
    document.getElementById('player').innerHTML = '<iframe width="100%" height="400" src="https://www.youtube.com/embed/' + videoId + '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
  }

  function getVideoId(link) {
    var video_id = link.split('v=')[1];
    var ampersandPosition = video_id.indexOf('&');
    if (ampersandPosition != -1) {
      video_id = video_id.substring(0, ampersandPosition);
    }
    return video_id;
  }