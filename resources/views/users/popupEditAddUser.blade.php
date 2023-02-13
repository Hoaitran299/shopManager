<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-info">
            <h4 class="modal-title" id="popupTitle">Thêm User</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <form id="userForm" class="form-horizontal">
            <div class="modal-body">
                <div class="form-group">
                    <label>Tên</label>
                    <input type="text" class="form-control" id="name" name="name"
                        placeholder="Nhập họ tên">
                        <span class="text-danger msg-error" id="name-error"></span>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                    <span class="text-danger msg-error" id="email-error"></span>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu">
                    <span class="text-danger msg-error" id="password-error"></span>
                </div>
                <div class="form-group">
                    <label>Xác nhận</label>
                    <input type="password" class="form-control" id="password_confirm" name="password_confirm"
                        placeholder="Xác nhận mật khẩu">
                        <span class="text-danger msg-error" id="password_confirm-error"></span>
                </div>
                <div class="form-group">
                    <label>Nhóm</label>
                    {!! Form::select('group_role', ['Admin' => 'Admin', 'Editor' => 'Editor', 'Reviewer' => 'Reviewer'], null, [
                        'class' => 'form-control',
                        'id' => 'group_role',
                        'name' => 'group_role',
                    ]) !!}
                </div>

                <div class="form-group">
                    <label class="">Trạng thái</label>
                    <input type="checkbox" checked data-toggle="toggle" data-onstyle="success" data-offstyle="secondary"
                        id="is_active" name="is_active" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="closePopup" name="closePopup" class="btn btn-secondary"
                    data-dismiss="modal">Hủy</button>
                <button id="btnAddSave" name="btnSave" type="submit" class="btn btn-danger btnSave">Lưu</button>
            </div>
        </form>
    </div>
</div>
