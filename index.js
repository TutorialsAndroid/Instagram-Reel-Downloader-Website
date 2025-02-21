function fetchReel() {
    const url = document.getElementById('instaUrl').value;
    if (!url) {
        alert('Please enter a valid Instagram URL');
        return;
    }

    fetch('index.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'url=' + encodeURIComponent(url)  // Pass the URL entered in the input
    })
    .then(response => response.json())
    .then(data => {
        if (!data.error) {
            document.getElementById('videoPreview').src = data.download_url;
            document.getElementById('caption').innerText = data.caption;
            document.getElementById('reelPreview').style.display = 'block';
        } else {
            alert('Error fetching the reel. Please try again.');
        }
    })
    .catch(error => console.error('Error:', error));
}


function downloadReel() {
    const videoUrl = document.getElementById('videoPreview').src;
    const timestamp = new Date().getTime();
    fetch(videoUrl)
        .then(response => response.blob())
        .then(blob => {
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `reel_${timestamp}.mp4`;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            window.URL.revokeObjectURL(url);
        })
        .catch(error => console.error('Error downloading video:', error));
}