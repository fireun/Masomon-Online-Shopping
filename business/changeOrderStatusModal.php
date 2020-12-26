<!-- Modal -->
<form action="../database/seller/productAction.php" method="post">
  <div class="modal fade" id="changeOrderStatusModal" tabindex="-1" aria-labelledby="changeOrderStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="changeOrderStatusModalLabel">Change Order Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-lg-12">
          <input type="hidden" name="cartIntegrationId" id="updateStatusOrderId"><!---update id cartIntegration-->
          <input type="hidden" name="cartId" id="updateStatusCartId"><!---update id cartId-->
          <select class="custom-select" name="selectUpdateStatus" id="displayStatusContent">
              <option selected> -- Choose One Option --</option>
              <option value="comfirm">comfirm</option>
              <option value="packging">packging</option>
              <option value="shipping">shipping</option>
          </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="updateCartIntegrationStatus" class="btn btn-primary">Save changes</button>
        </div> 
      </div>
    </div>
  </div>
</form>