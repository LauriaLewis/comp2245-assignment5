window.onload = function () {
  var countrybtnlookup = document.getElementById("lookup");
  countrybtnlookup.addEventListener("click", function () {
    let country = document.getElementById("country").value;
    let url = "http://localhost/comp2245-assignment5/world.php?country=";

    let dhttp = new XMLHttpRequest();
    let result = document.getElementById("result");
    dhttp.onreadystatechange = function () {
      if (this.readyState == XMLHttpRequest.DONE && this.status == 200) {
        result.innerHTML = dhttp.response;
      }
    };

    dhttp.open("GET", url + country, true);
    dhttp.send();
  });

  var citybtnlookup = document.getElementById("lookup-cities");
  citybtnlookup.addEventListener("click", function () {
    let country = document.getElementById("country").value; 
    let url = `http://localhost/comp2245-assignment5/world.php?context=${country}&lookup=cities`;

    let dhttp = new XMLHttpRequest();
    let result = document.getElementById("result");
    dhttp.onreadystatechange = function () {
      if (this.readyState == XMLHttpRequest.DONE && this.status == 200) {
        result.innerHTML = dhttp.response;
      }
    };

    dhttp.open("GET", url, true);
    dhttp.send();
  });
};
