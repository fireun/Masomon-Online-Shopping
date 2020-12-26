  <!-- change track status -->
  <form action="../database/warehouse/actionProcess.php" method="POST">
  <div class="modal fade" id="updateTrack" tabindex="-1" role="dialog" aria-labelledby="updateTrackLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateTrackLabel">Update Tracking Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <input type="hidden" name="trackId" id="updateTrackId">
          <input type="hidden" name="ordedrId" id="updateOrderId">
        </div>
        <div class="modal-body" id="StockContent">
                <div class="row">
                    <div class="col-xl-12">
                        <select class="custom-select" name="status" id="searchStatus" onmousedown="if(this.options.length>4){this.size=4;}"  onchange='this.size=0;' onblur="this.size=0;">
                          <option selected value="Closed">Completed</option>
                          <!-- <option value="In Transit">In Transit</option>
                          <option value="Picked Up">Picked Up</option>
                          <option value="Pending">Pending</option> -->
                          <!-- <option value="Out Of Delivery">Out Of Delivery</option> -->
                          <!-- <option ></option> -->
                        </select>
                    </div>
                    <div class="col-xl-12 mt-3">
                        <input type="text" name="receiverInfo" class="form-control" placeholder="Enter Receiver Information (Name + IC)...">
                    </div>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="updatedClosedPackage" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
 </form>