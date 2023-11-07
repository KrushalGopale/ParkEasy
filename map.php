<?php
// Include the database configuration file 
require_once 'config/config.php';

// Fetch the marker info from the database 
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

// Close the database connection
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
            /* Add space above the h3 element */
            margin-bottom: 10px;
            /* Add space below the h3 element */
            margin-left: 0;
            /* Add space to the left of the h3 element */
            margin-right: 0;
            /* Add space to the right of the h3 element */
            padding: 5px;
            
        }

        p {
            font-size: 20px;
            font-weight: 500;
            margin-top: 10px;
            /* Add space above the h3 element */
            margin-bottom: 10px;
            /* Add space below the h3 element */
            margin-left: 0;
            /* Add space to the left of the h3 element */
            margin-right: 0;
            /* Add space to the right of the h3 element */
            padding: 5px;
        }

        /* Adjust mapCanvas size for responsiveness */
        #mapCanvas {
            width: 100%;
            height: 869px;
            /* You can adjust the height as needed */
        }

        /* Style for the "Book Now" button */
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnIghaBCXo7FLxLCnwtYdPvK1i8MN1WGE"></script>

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

                    // Use event delegation to handle marker click events
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
                // Create a form element dynamically
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = 'confirmbook.php';

                // Create hidden input fields for passing data
                var nameInput = document.createElement('input');
                nameInput.type = 'hidden';
                nameInput.name = 'name';
                nameInput.value = name;
                form.appendChild(nameInput);

                // Submit the form
                document.body.appendChild(form);
                form.submit();


            }

            google.maps.event.addDomListener(window, 'load', initMap);
        </script>
    </div>
</body>

</html>