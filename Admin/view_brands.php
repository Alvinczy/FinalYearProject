<h3 class="text-center text-success">All Brands</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info ">
        <tr class="text-center">
            <th >S1no</th>
            <th>Brand title</th>
            <th>Edit</th>
            <th>Delete</th>
           
        </tr>
    </thead>
    <tbody class="bg-secondary text-light">
         <?php
$select_cat="Select * from `brands`";
$result= mysqli_query($con, $select_cat);
$number=0;
while ($row= mysqli_fetch_assoc($result)){
    $brand_id=$row['brand_id'];
    $brand_title=$row['brand_title'];
    $number++;

?>
        <tr class="text-center">
            <td><?php echo $number; ?></td>
            <td><?php echo $brand_title ;?></td>
            <td><a href='Admin_panel.php?edit_brands=<?php echo $brand_id ?>' class='text-light'><i class='fa-solid fa-pen-to-square'></i></a></td>
              <td><a href='Admin_panel.php?delete_brands=<?php echo $brand_id ?>' type="button" class="text-light" data-bs-toggle="modal" data-bs-target="#exampleModal"  ><i class='fa-solid fa-trash'></i></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-body">
          <h4>Are you sure you want to delete this?</h4>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><a href="./Admin_panel.php?view_brands" class="text-light text-decoration-none">No</a></button>
        <button type="button" class="btn btn-primary"><a  href='Admin_panel.php?delete_brands=<?php echo $brand_id ?>'  class="text-decoration-none text-light" >Yes</a></button>
      </div>
    </div>
  </div>
</div>

 