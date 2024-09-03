'use strict';

/**
 * navbar toggle
 */

const overlay = document.querySelector("[data-overlay]");
const navOpenBtn = document.querySelector("[data-nav-open-btn]");
const navbar = document.querySelector("[data-navbar]");
const navCloseBtn = document.querySelector("[data-nav-close-btn]");

const navElemArr = [overlay, navOpenBtn, navCloseBtn];

for (let i = 0; i < navElemArr.length; i++) {
  navElemArr[i].addEventListener("click", function () {
    navbar.classList.toggle("active");
    overlay.classList.toggle("active");
  });
}



/**
 * add active class on header when scrolled 200px from top
 */

const header = document.querySelector("[data-header]");

window.addEventListener("scroll", function () {
  window.scrollY >= 200 ? header.classList.add("active")
    : header.classList.remove("active");
})

function homeSearch() {



  var txt = document.getElementById("searchTxt").value;
  var results = document.getElementById("results");

  var f = new FormData();
  f.append("s", txt);


  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {

    if (r.readyState == 4) {
      var t = r.responseText;



      results.innerHTML = t;

    }

  }

  r.open("POST", "searchProcess.php", true);
  r.send(f);


}

function homeSearchSm() {



  var txt = document.getElementById("searchTxt1").value;
  var results = document.getElementById("results");

  var f = new FormData();
  f.append("s", txt);


  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {

    if (r.readyState == 4) {
      var t = r.responseText;



      results.innerHTML = t;


      var modal = document.getElementById("modal");
      modal.classList.add("displayNone");
      modal.classList.remove("displayFlex");



    }

  }

  r.open("POST", "searchProcess.php", true);
  r.send(f);


}

function showSmSearch() {
  var modal = document.getElementById("modal");
  modal.classList.remove("displayNone");
  modal.classList.add("displayFlex");
}

function searchCat(id) {

  var f = new FormData();

  f.append("id", id);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {

      var t = this.responseText;

      document.getElementById("results").innerHTML = t;

    }
  }


  r.open("POST", "searchCatProcess.php", true);
  r.send(f);

}
function allProduct() {




  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {

      var t = this.responseText;

      document.getElementById("results").innerHTML = t;

    }
  }


  r.open("POST", "setAllProducts.php", true);
  r.send();

}

function addToCart(id) {

  var sizeId = document.querySelector('input[name="size"]:checked').id;
  var colorId = document.querySelector('input[name="color"]:checked').id;
  var qty = document.getElementById("qty_input").value;

  var f = new FormData();

  f.append("id", id);
  f.append("sid", sizeId);
  f.append("cid", colorId);
  f.append("q", qty);

  
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      // alert (t);
      window.location.reload();
    }
  }

  r.open("POST", "addToCartProcess.php", true);
  r.send(f);
}
function deleteFromCart(id) {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;

      if (t == "Product has been removed") {
        // alert (t);
        window.location.reload();
      } else {
        alert(t);
      }
    }
  }

  r.open("GET", "removeCartProcess.php?id=" + id, true);
  r.send();
}

function addToWatchlist(id) {

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "added") {

        window.location.reload();
      } else if (t == "removed") {

        window.location.reload();
      } else {
        alert(t);
      }
    }
  }

  r.open("GET", "addToWatchlistProcess.php?id=" + id, true);
  r.send();

}

function removeFromWatchlist(id) {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location.reload();
      } else {
        alert(t);
      }

    }
  }

  r.open("GET", "removeWatchlistProcess.php?id=" + id, true);
  r.send();
}





function sortAdvancedSearch() {

  var sortSelectValue = document.getElementById('sortSelect').value;
  var selectedColor = getSelectedRadioValue('.clrR');
  var selectedSize = getSelectedRadioValue('.sizeR');
  // var selectedItem = getSelectedRadioValue('.itemR');

  // alert("Sort: " + sortSelectValue + "\nSelected Color ID: " + selectedColor + "\nSelected Size ID: " + selectedSize + "\nSelected Item ID: " + selectedItem);

  var f = new FormData();

  // f.append("iid", selectedItem);
  f.append("sid", selectedSize);
  f.append("cid", selectedColor);
  f.append("I", sortSelectValue);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {

      var t = this.responseText;

      // alert(t);

      document.getElementById("sort-sec").innerHTML = t;

    }
  }


  r.open("POST", "advancedSearch.php", true);
  r.send(f);






}

function getSelectedRadioValue(className) {
  
  var radioButtons = document.querySelectorAll(className);

  
  for (var i = 0; i < radioButtons.length; i++) {
      var radioButton = radioButtons[i];

      
      if (radioButton.checked) {
          
          return radioButton.id;
      }
  }

  
  return null;
}




function toggleSelected(img) {
  let imageId = img.id;
  if (selectedImageId === imageId) {
    // If the clicked image is already selected, deselect it
    img.classList.remove('selected-checkbox');
    selectedImageId = null;
  } else {
    // Deselect the previously selected image
    let prevSelectedImage = document.getElementById(selectedImageId);
    if (prevSelectedImage) {
      prevSelectedImage.classList.remove('selected-checkbox');
    }
    // Select the clicked image
    img.classList.add('selected-checkbox');
    selectedImageId = imageId;
  }
}

function moreSize() {
  var a2 = document.getElementById("a2");
   var div = document.getElementById("sortSize");

  if (a2.innerText === "- Show less") {
    a2.innerText = "+ Show More";

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
      if (r.readyState == 4) {
        var t = r.responseText;
        
        div.innerHTML=t;
        
  
      }
    }
  
    r.open("GET", "lessSize.php", true);
    r.send();



  } else if (a2.innerText === "+ Show More") {
    a2.innerText = "- Show less";

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
      if (r.readyState == 4) {
        var t = r.responseText;
        div.innerHTML=t;
       
      }
    }
  
    r.open("GET", "moreSize.php", true);
    r.send();
  }
}

function moreClr() {
  var a1 = document.getElementById("a1");

  var div = document.getElementById("sortClr");

  if (a1.innerText === "- Show less") {
    a1.innerText = "+ Show More";

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
      if (r.readyState == 4) {
        var t = r.responseText;
        
        div.innerHTML=t;
        
  
      }
    }
  
    r.open("GET", "lessClr.php", true);
    r.send();


  } else if (a1.innerText === "+ Show More") {
    a1.innerText = "- Show less";

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
      if (r.readyState == 4) {
        var t = r.responseText;
        div.innerHTML=t;
       
      }
    }
  
    r.open("GET", "moreClr.php", true);
    r.send();
  }
}

function moreItems() {
  var a3 = document.getElementById("a3");
  var div = document.getElementById("sortItem");

  if (a3.innerText === "- Show less") {
    a3.innerText = "+ Show More";

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
      if (r.readyState == 4) {
        var t = r.responseText;
        
        div.innerHTML=t;
        
  
      }
    }
  
    r.open("GET", "lessItems.php", true);
    r.send();

  } else if (a3.innerText === "+ Show More") {
    a3.innerText = "- Show less";

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
      if (r.readyState == 4) {
        var t = r.responseText;
        
        div.innerHTML=t;
        
  
      }
    }
  
    r.open("GET", "moreItems.php", true);
    r.send();
  }
}

