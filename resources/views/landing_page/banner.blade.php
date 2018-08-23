<!-- Banner -->
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

	<div class="banner">
		<div class="container fill_height">
			
      <div class="row fill_height">
				<div class="col-lg-6 offset-lg-3 fill_height">				
					
          <div class="w3-content w3-display-container" style="margin-left: 10px;">
            <img class="mySlides" src="https://www.w3schools.com/w3css/img_snowtops.jpg" style="width:100%">
            <img class="mySlides" src="https://www.w3schools.com/w3css/img_lights.jpg" style="width:100%">
            <img class="mySlides" src="https://www.w3schools.com/w3css/img_mountains.jpg" style="width:100%">
            <img class="mySlides" src="https://www.w3schools.com/w3css/img_forest.jpg" style="width:100%">
            <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
            <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
          </div>        
				</div>

        <div class="col-lg-3" style="height: 250px; margin-top: 10px">
          <div style="background: #B0B0B0;  height: 160px; text-align: center;" >
            <img style="margin-top: 10px; margin-left:0px " width="95%" height="45%" src="https://play.google.com/intl/en_us/badges/images/badge_new.png">
            
            <img style="margin-left: 0px" width="95%" height="45%" src="https://www.imro.ie/wp-content/uploads/2017/09/app-store-image.png">  
          </div>

          <div style="background: #C4C278; height: 85px; margin-top: 10px">
            
          </div>

          <div style="background: #95C378; height: 85px; margin-top: 10px">
            
          </div>
        </div>


        <div class="col-lg-9 offset-lg-3 fill_height">        
          
          <h1 style="text-align: center;">Animasi Penjelasan System Rental</h1>
        </div>


			</div>
		</div>
	</div>

  <script>
    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
      showDivs(slideIndex += n);
    }

    function showDivs(n) {
      var i;
      var x = document.getElementsByClassName("mySlides");
      if (n > x.length) {slideIndex = 1}    
      if (n < 1) {slideIndex = x.length}
      for (i = 0; i < x.length; i++) {
         x[i].style.display = "none";  
      }
      x[slideIndex-1].style.display = "block";  
    }
  </script>