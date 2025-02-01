<?php
require_once 'config/config.php';

$sql = "SELECT * FROM locations";
$result = $conn->query($sql);
$markers = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $markers[] = [
            'name' => $row['name'],
            'latitude' => $row['latitude'],
            'longitude' => $row['longitude'],
            'available_slots' => $row['available_slots'],
            'price' => $row['price'],
        ];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locations</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            background-color: #FFF0F5;
            font-family: Manrope, sans-serif;
        }

        .div {
            background-color: #4a4a48;
            border: none;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .div-11 {
            padding-right: 70px;
        }

        h3 {
            font-size: 25px;
            color: #f84646;
            margin-top: 10px;
            margin-bottom: 10px;
            margin-left: 0;
            margin-right: 0;
            padding: 5px;
            
        }

        p {
            font-size: 20px;
            font-weight: 500;
            margin-top: 10px;
            margin-bottom: 10px;
            margin-left: 0;
            margin-right: 0;
            padding: 5px;
        }

        #mapCanvas {
            width: 100%;
            height: 869px;
        }

        .button {
            background-color: #f84646;
            color: #fff;
            font-size: 14px;
            font-weight: 700;
            border: none;
            padding: 13px 20px;
            margin: 100px;
            border-radius: 5px;
            cursor: pointer;
        }

        .button:hover {
            background-color: rgb(124, 124, 124);
        }

        a{
            text-decoration: none;
        }
    </style>
</head>
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>

<body>
    <div class="div">
        <div class="div-4">
            <div class="div-5">
                <img loading="lazy" srcset="assets/images/logo.jpg" class="img-2" />
                <div class="div-6">ParkEasy</div>
            </div>
            <div class="div-7">
                <a href="index.php" class="div-8">
                    <div class="div-8">Home</div>
                </a>
                <a href="logout.php" id="div-100">
                    <div class="div-11">Logout</div>
                </a>
            </div>
        </div>
    </div>
    <div id="mapCanvas">
        <script>
            function initMap() {
                var map;
                var bounds = new google.maps.LatLngBounds();
                var mapOptions = {
                    mapTypeId: 'roadmap'
                };

                map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
                map.setTilt(50);

                var markers = <?php echo json_encode($markers); ?>;

                var infoWindow = new google.maps.InfoWindow();

                for (var i = 0; i < markers.length; i++) {
                    var markerData = markers[i];
                    var position = new google.maps.LatLng(markerData.latitude, markerData.longitude);
                    bounds.extend(position);
                    var marker = new google.maps.Marker({
                        position: position,
                        map: map,
                        title: markerData.name
                    });

                    google.maps.event.addListener(marker, 'click', function(markerData) {
                        return function() {
                            var content = '<div><h3>' + markerData.name + '</h3>' +
                                '<p>Available Slots: ' + markerData.available_slots + '</p>' +
                                '<p>Price: ₹' + markerData.price + '</p>' +
                                '<a href="confirmbook.php?name=' + encodeURIComponent(markerData.name) +
                                '&price=' + markerData.price + '" class="button">Book Now</a>' + '</div>'; 
                            infoWindow.setContent(content);
                            infoWindow.open(map, this);
                        }
                    }(markerData));
                }

                map.fitBounds(bounds);
            }

            function showBookingForm(name, price) {
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = 'confirmbook.php';

                var nameInput = document.createElement('input');
                nameInput.type = 'hidden';
                nameInput.name = 'name';
                nameInput.value = name;
                form.appendChild(nameInput);

                document.body.appendChild(form);
                form.submit();


            }

            google.maps.event.addDomListener(window, 'load', initMap);
        </script>
    </div>
</body>

</html>
