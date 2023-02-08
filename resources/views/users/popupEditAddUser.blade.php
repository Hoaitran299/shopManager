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
                    <input type="text" class="form-control" id="name"
                        name="name" placeholder="Nhập họ tên">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" id="email"
                        name="email" placeholder="Email" >
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu">
                </div>
                <div class="form-group">
                    <label>Xác nhận</label>
                    <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Xác nhận mật khẩu">
                </div>
                <div class="form-group">
                    <label>Nhóm</label>
                    {!! Form::select('group_role', [1 => 'Admin', 2 => 'Editor', 3 => 'Reviewer'], null, [
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
                <button id="btnSave" name="btnSave" type="submit"
                    class="btn btn-danger btnSave">Lưu</button>
            </div>
        </form>
    </div>
</div>
