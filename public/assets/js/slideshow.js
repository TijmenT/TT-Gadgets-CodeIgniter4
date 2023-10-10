function showImage1() {
    var image3 = document.getElementById("image3");
    image3.style.display = "none";
    var image1 = document.getElementById("image1");
    image1.style.display = "block";
    setTimeout(showImage2, 5000); 
  }
  
  function showImage2() {
    var image1 = document.getElementById("image1");
    image1.style.display = "none";
    var image2 = document.getElementById("image2");
    image2.style.display = "block";
    setTimeout(showImage3, 5000); 
  }
  
  function showImage3() {
    var image2 = document.getElementById("image2");
    image2.style.display = "none";
    var image3 = document.getElementById("image3");
    image3.style.display = "block";
    setTimeout(showImage1, 5000);
  }
  
  document.addEventListener("DOMContentLoaded", function() {
    showImage1(); 
  });