function createList() {
    var query = document.getElementById('searchTitle').value;
    var vars = 'search='+encodeURIComponent(query);
    var url = "search.php";
      var req = new XMLHttpRequest();
      if (!req) {
      throw 'Unable to create HttpRequest.';
      }

      req.onreadystatechange = function() {
          if (this.readyState === 4 && req.status === 200) {
            var return_data = req.responseText
            console.log(return_data);
            console.log(return_data.username);
            document.getElementById("results").innerHTML = return_data;
          }                  
       };
    req.open('POST', url, true);
    req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    req.send(vars);
    document.getElementById("results").innerHTML = "processing...";
  }

 function addLibrary(id) {
 	var query = id;
    var vars = 'gameid='+id;
    var url = "library.php";
      var req = new XMLHttpRequest();
      if (!req) {
      throw 'Unable to create HttpRequest.';
      }

      req.onreadystatechange = function() {
          if (this.readyState === 4 && req.status === 200) {
            var return_data = req.responseText;
      		document.getElementById("results").innerHTML = return_data;
          }                  
       };
    req.open('POST', url, true);
    req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    req.send(vars);
    document.getElementById("results").innerHTML = "processing...";
 }