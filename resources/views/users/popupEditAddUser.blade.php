<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-info">
            <h4 class="modal-title" id="popupTitle">Thêm User</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="addUserForm" class="form-horizontal">
            <div class="modal-body">
                @csrf
                <div class="form-group">
                    <label>Tên</label>
                    <input type="text" class="form-control" id="addName" name="addName"
                        placeholder="Nhập họ tên">
                    <span id="errName" class="text-danger d-none"></span>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" id="addEmail" name="addEmail" placeholder="Email">
                    <span id="errEmail" class="text-danger d-none"></span>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="addPassword" name="addPassword"
                        placeholder="Mật khẩu">
                    <span id="errPassword" class="text-danger d-none"></span>
                </div>
                <div class="form-group">
                    <label>Xác nhận</label>
                    <input type="password" class="form-control" id="addPasswordConfirm" name="addPasswordConfirm"
                        placeholder="Xác nhận mật khẩu">
                    <span id="errpasswordConfirm" class="text-danger d-none"></span>
                </div>
                <div class="form-group">
                    <label>Nhóm</label>
                    {!! Form::select('group_role', [1 => 'Admin', 2 => 'Editor', 3 => 'Reviewer'], null, [
                        'placeholder' => 'Chọn nhóm...',
                        'class' => 'form-control',
                        'id' => 'addGroupRole',
                        'name' => 'addGroupRole'
                    ]) !!}
                    <span id="errGroupRole" class="text-danger d-none"></span>
                </div>

                <div class="form-group">
                    <label class="">Trạng thái</label>
                    <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch id="addActive"
                        name="addActive">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="closePopup" name="closePopup" class="btn btn-secondary"
                    data-dismiss="modal">Hủy</button>
                <button id="addButton" name="addButton" type="submit" class="btn btn-danger">Lưu</button>
            </div>
        </form>
    </div>
</div>
