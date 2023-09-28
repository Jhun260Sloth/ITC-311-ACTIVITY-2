
<body>
 <!-- BODY  -->

 <!-- Search  -->

    <form action="/" method="get">
      <input type="search" name="search" placeholder="search song">
      <button type="submit" class="btn btn-primary">search</button>
    </form>


  <br>
    <h1>Music Player</h1>
  <br>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Playlist </button>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#musicup">Upload Music </button>


    <audio id="audio" controls autoplay></audio>

    <ul id="playlist">

      <?php foreach ($player as $ms): ?>
          <li data-src="<?= $ms['file_path']; ?>">
              <?= $ms['file']; ?>
          </li>
      <?php endforeach; ?>
      
    </ul>





 <!-- Modals -->

 <!-- My Playlist Modal -->

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">My Playlist</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
              <label for="SelectProdCat" class="form-label">Select</label>
                <select class="form-select d-inline-block ml-2" name="SelectProdCat" id="SelectProdCat">
                    <?php
                    $seenItems = array(); // Initialize an array to store seen items

                    foreach ($player as $ms) {
                        $item = $ms['playslist'];

                        // Check if the item has been seen before
                        if (!in_array($item, $seenItems)) {
                            echo "<option>{$item}</option>";
                            $seenItems[] = $item; // Add the item to the seenItems array
                        }
                    }
                    ?>
                </select>
        </div>

        <div class="modal-footer">
          <a type="button" class="btn btn-danger" href="#" data-bs-dismiss="modal">Close</a>
          <a type="button" class="btn btn-success" href="#" href="#" data-bs-toggle="modal" data-bs-target="#createPlaylist">Create New Playlist</a>

        </div>
      </div>
    </div>
  </div>




    <!--Create New  Modal -->

      <div class="modal fade" id="createPlaylist" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Create New Playlist</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
             

              <form action="/insert" method="post">


                <input type="text" name="cplaylist" placeholder="Enter Playlist">
               
             


            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success">Create</button>

                </form>

            </div>
          </div>
        </div>
      </div>




      <!--Upload Music  Modal -->

      <div class="modal fade" id="musicup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Upload</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           
            <div class="modal-body">

        <form action="/insert" method="post" enctype="multipart/form-data">


              <label for="SelectProdCat2" class="form-label">Select Playlist</label>
              <select class="form-select d-inline-block ml-2" name="cplaylist" id="SelectProdCat2">
                  <?php
                  $seenItems = array();
                  foreach ($player as $ms) {
                      $item = $ms['playslist'];

                      if (!in_array($item, $seenItems)) {
                          echo "<option>{$item}</option>";
                          $seenItems[] = $item;
                      }
                  }
                  ?>
              </select>
              <br><br>

          <input type="file" name="filepath"> <br> <br>


              <!-- Remove the hidden input for cplaylist, as it's now part of the <select> element -->

              <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-success">Upload</button>
              </div>
          </form>

                <script>
                      function setInitialValue() {
                          var firstOption = document.querySelector('#SelectProdCat2 option:first-child');
                          var initialValue = firstOption ? firstOption.value : '';
                          document.getElementById('cplaylist').value = initialValue;
                      }
                      document.getElementById('SelectProdCat2').addEventListener('change', function () {
                          var selectedOption = this.value;
                          document.getElementById('cplaylist').value = selectedOption;
                      });
                      window.addEventListener('load', setInitialValue);
                </script>


            </div>
          </div>
        </div>
      </div>
    
</body>
