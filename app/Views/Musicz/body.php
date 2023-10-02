
<body>
 <!-- BODY  -->

 <!-- Search  -->

  <form action="/search" method="get">
    <input type="search" name="search" placeholder="Search for songs">
    <button type="submit" class="btn btn-primary">Search</button>
</form>


  <br>
    <h1>Music Player</h1>
  <br>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Playlist </button>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#musicup">Upload Music </button>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#musicup2">Edit List </button>


    <audio id="audio" controls autoplay></audio>

    <ul id="playlist">

      <?php foreach ($player as $ms): ?>
        <li data-src="<?= $ms['file_path']; ?>" data-category="<?= $ms['listtype']; ?>">
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

               <select class="form-select d-inline-block ml-2" name="SelectProdCat" id="categorySelect">
                  <option value="all">All Categories</option>
                  <?php
                  $seenItems = array(); 
                  foreach ($player as $ms) {
                      $item = $ms['listtype'];

                      
                      if (!in_array($item, $seenItems)) {
                          echo "<option value='$item'>$item</option>";
                          $seenItems[] = $item; 
                      }
                  }
                  ?>
              </select>

        </div>

        <script>
            // JavaScript to filter the list based on the selected category
            const categorySelect = document.getElementById('categorySelect');
            const playlistItems = document.querySelectorAll('#playlist li');

            categorySelect.addEventListener('change', function () {
                const selectedCategory = categorySelect.value;

                playlistItems.forEach(item => {
                    const itemCategory = item.getAttribute('data-category');

                    if (selectedCategory === 'all' || selectedCategory === itemCategory) {
                        item.style.display = 'list-item'; // Show items that match the category or "All Categories"
                    } else {
                        item.style.display = 'none'; // Hide items that don't match the selected category
                    }
                });
            });
        </script>

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

               <label for="SelectProdCat" class="form-label">Current Playlist</label>
             <select class="form-select d-inline-block ml-2" name="SelectProdCat">
                    <?php
                    $seenItems = array(); // Initialize an array to store seen items

                    foreach ($playL as $mh) {
                        $item = $mh['playlist'];

                        // Check if the item has been seen before
                        if (!in_array($item, $seenItems)) {
                            echo "<option>{$item}</option>";
                            $seenItems[] = $item; // Add the item to the seenItems array
                        }
                    }
                    ?>
                </select>
<br>
<br>
 <label for="SelectProdCat" class="form-label">Enter New Playlist</label>
              <form action="/insert2" method="post">


                <input type="text" name="cplaylist" placeholder="">
               

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
              foreach ($playL as $mh) {
                  $item = $mh['playlist'];
                  echo "<option value='$item'>$item</option>";
              }
              ?>
          </select>

      <input type="hidden" name="play" id="selectedPlaylist">

          <br><br>
          <input type="file" name="filepath"> <br> <br>

          <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-success">Upload</button>
          </div>
    
   
  </form>

      <script>
          document.getElementById('SelectProdCat2').addEventListener('change', function () {
              var selectedOption = this.value;
              document.getElementById('selectedPlaylist').value = selectedOption;
          });
      </script>


            </div>
          </div>
        </div>
      </div>
    



      <!--Upload Music  Modal -->

      <div class="modal fade" id="musicup2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Upload</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           
            <div class="modal-body">
<center>
              <table>

                <tbody>
                    <?php foreach ($player as $ms): ?>
                        <tr>
                            <td><?= $ms['file']; ?></td>
                            <td></td>
                            <td data-category="<?= $ms['listtype']; ?>"><?= $ms['listtype']; ?></td>
                            <td></td>
                            <td></td>
                            <td>
                                <a href="/delete/<?= $ms['id']?>" class="">Delete</a>
                          </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
</center>
        
          <div class="modal-footer">
              
          </div>
    

            </div>
          </div>
        </div>
      </div>
    
</body>
