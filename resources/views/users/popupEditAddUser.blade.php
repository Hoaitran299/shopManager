<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-info">
            <h4 class="modal-title" id="popupTitle">Thêm User</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="addUserForm" class="form-horizontal" action="">
            @csrf
            <div class="modal-body">
                @csrf
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
                    <label>Password</label>
                    <input type="password" class="form-control" id="inputPassword" name="inputPassword"
                        placeholder="Mật khẩu">
                </div>
                <div class="form-group">
                    <label>Xác nhận</label>
                    <input type="password" class="form-control" id="inputPasswordConfirm" name="inputPasswordConfirm"
                        placeholder="Xác nhận mật khẩu">
                </div>
                <div class="form-group">
                    <label>Nhóm</label>
                    {!! Form::select('group_role', [1 => 'Admin', 2 => 'Editor', 3 => 'Reviewer'], null, [
                        'class' => 'form-control',
                        'id' => 'selGroupRole',
                        'name' => 'selGroupRole'
                    ]) !!}
                </div>

                <div class="form-group">
                    <label class="">Trạng thái</label>
                    <input type="checkbox" checked data-toggle="toggle" data-onstyle="success" data-offstyle="secondary" id="checkActive" name="checkActive"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="closePopup" name="closePopup" class="btn btn-secondary"
                    data-dismiss="modal">Hủy</button>
                <button id="addUserButton" name="addUserButton" type="submit" class="btn btn-danger addUserButton">Lưu</button>
            </div>
        </form>
    </div>
</div>
