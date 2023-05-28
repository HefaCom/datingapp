<!DOCTYPE html>
<html>
<head>
	<title>Change Background Image</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		$(document).ready(function(){
			var images = ['1.jpg', '2.jpg', '3.jpg','4.jpg', '5.jpg', '6.jpg'];
			var currentIndex = 0;

			function changeBackground() {
				$('body').css('background-image', 'url(images/' + images[currentIndex] + ')');
				currentIndex++;
				if (currentIndex == images.length) {
					currentIndex = 0;
				}
			}

			setInterval(changeBackground, 5000); // Change image every 5 seconds
		});
	</script>
</head>
<body>
	<!-- Your page content here -->
</body>
</html>
