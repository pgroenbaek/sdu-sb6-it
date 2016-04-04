
<?php require VIEW_DIR . '/header.php' ?>

    <div class="menu">
      <a href="/" class="selected">Gallery</a>&nbsp;&nbsp;
      <a href="/users">User list</a>&nbsp;&nbsp;
      <a href="/logout" class="right">Log out</a>&nbsp;&nbsp;
      <a href="/upload" class="right">Upload image</a>
    </div>

    <div class="content">
      <h1>Gallery</h1>

      <div id="gallery">

        <?php require VIEW_DIR . '/ajax/gallerypage.php' ?>

      </div>
    </div>

    <script type="text/javascript">

      function ajaxPageRequest(method, url, pagenum) {
        return new Promise(function (resolve, reject) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open(method, url);
            xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xmlhttp.onload = function() {
              if (xmlhttp.status == 200) {
                resolve(xmlhttp.responseText);
              }
              else {
                reject('An error occurred: ' + xmlhttp.statusText);
              }
            };
            xmlhttp.onerror = function() {
              reject('An error occurred while loading the requested page!');
            };
            xmlhttp.send('page=' + pagenum);
        });
      }


      function showPage(pagenum) {
        if (pagenum == null) {
            document.getElementById("gallery").innerHTML = "";
            return;
        } else {

          var pageRequest = ajaxPageRequest('POST', '/', pagenum)
          pageRequest.then(
            function (result) { // Success
              document.getElementById("gallery").innerHTML = result;
            },
            function (e) { // Error
              alert(e);
            }
          );

        }
      }


      /*
      var Person = function () {
        console.log('instance created');
      };

      var person1 = new Person();
      var person2 = new Person();




      var Person = function (firstName) {
        this.firstName = firstName;
      };

      Person.prototype.sayHello = function() {
        console.log("Hello, I'm " + this.firstName);
      };

      var person1 = new Person("Alice");
      var person2 = new Person("Bob");

      person1.sayHello(); // logs "Hello, I'm Alice"*/






      /*var counter = 0;
      function add() {
        counter += 1;
      }

      add();
      add();
      add();
      // 3


      function add() {
        var counter = 0;
        counter += 1;
      }

      add();
      add();
      add();
      // 0



      // Closure
      var add = (function () {
        var counter = 0;
        return function () {return counter += 1;}
      })();

      add();
      add();
      add();*/





    </script>

<?php require VIEW_DIR . '/footer.php' ?>
