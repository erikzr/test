document.getElementById('startCamera').addEventListener('click', function() {
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(function(stream) {
            document.getElementById('video').srcObject = stream;
        })
        .catch(function(err) {
            console.error("An error occurred: " + err);
        });
});

document.getElementById('capture').addEventListener('click', function() {
    let video = document.getElementById('video');
    let canvas = document.getElementById('canvas');
    let photo = document.getElementById('photo');
    let context = canvas.getContext('2d');

    context.drawImage(video, 0, 0, canvas.width, canvas.height);

    navigator.geolocation.getCurrentPosition(function(position) {
        let now = new Date();
        let timestamp = now.toLocaleTimeString(); // Jam
        let date = now.toLocaleDateString(); // Tanggal
        let dayOfWeek = new Intl.DateTimeFormat('id-ID', { weekday: 'long' }).format(now); // Hari
        let latitude = position.coords.latitude.toFixed(5);
        let longitude = position.coords.longitude.toFixed(5);

        // Add text to image
        context.font = '20px Arial';
        context.fillStyle = 'white';
        context.strokeStyle = 'black';
        context.lineWidth = 2;
        context.textAlign = 'left';

        context.strokeText(`Pukul: ${timestamp}`, 10, 30);
        context.fillText(`Pukul: ${timestamp}`, 10, 30);
        context.strokeText(`Tanggal: ${date}`, 10, 60);
        context.fillText(`Tanggal: ${date}`, 10, 60);
        context.strokeText(`Hari: ${dayOfWeek}`, 10, 90);
        context.fillText(`Hari: ${dayOfWeek}`, 10, 90);
        context.strokeText(`Lokasi: Lat ${latitude}, Lon ${longitude}`, 10, 120);
        context.fillText(`Lokasi: Lat ${latitude}, Lon ${longitude}`, 10, 120);

        // Draw the image with text
        photo.src = canvas.toDataURL('image/png');

        // Display map
        let map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: position.coords.latitude, lng: position.coords.longitude },
            zoom: 15
        });

        new google.maps.Marker({
            position: { lat: position.coords.latitude, lng: position.coords.longitude },
            map: map,
            title: 'Your Location'
        });

        let geocoder = new google.maps.Geocoder();
        geocoder.geocode({ location: { lat: position.coords.latitude, lng: position.coords.longitude } }, function(results, status) {
            if (status === 'OK') {
                if (results[0]) {
                    let infoWindow = new google.maps.InfoWindow({
                        content: `<div><strong>${results[0].formatted_address}</strong></div>`
                    });
                    infoWindow.open(map, new google.maps.Marker({
                        position: { lat: position.coords.latitude, lng: position.coords.longitude },
                        map: map,
                        title: 'Your Location'
                    }));
                } else {
                    console.error('No results found');
                }
            } else {
                console.error('Geocoder failed due to: ' + status);
            }
        });
    }, function(error) {
        console.error("Error getting location: ", error);
    });
});
