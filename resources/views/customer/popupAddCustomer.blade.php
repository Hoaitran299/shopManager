<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-info">
            <h4 class="modal-title" id="popupTitle">Thêm khách hàng</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="addCustomerForm" class="form-horizontal">
            <div class="modal-body">
                <div class="form-group">
                    <label>Tên</label>
                    <input type="text" class="form-control" id="inputName" name="inputName"
                        placeholder="Nhập họ tên">
                    
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email">
                    
                </div>
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <input type="text" class="form-control" id="inputAddress" name="inputAddress"
                        placeholder="Nhập địa chỉ">
                </div>
                <div class="form-group">
                    <label>Điện thoại</label>
                    <input type="text" class="form-control" id="inputPhone" name="inputPhone"
                    placeholder="Nhập điện thoại">
                        
                </div>
                <div class="form-group">
                    <label class="">Trạng thái</label>
                    <input type="checkbox" checked data-toggle="toggle" data-onstyle="success" data-offstyle="secondary" id="checkActive" name="checkActive"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="closePopup" name="closePopup" class="btn btn-secondary"
                    data-dismiss="modal">Hủy</button>
                <button id="btnAddCustomer" name="btnAddCustomer" type="submit" class="btn btn-danger btnAddCustomer">Lưu</button>
            </div>
        </form>
    </div>
</div>
