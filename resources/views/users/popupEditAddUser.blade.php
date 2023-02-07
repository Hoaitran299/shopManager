<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-info">
            <h4 class="modal-title" id="popupTitle">Thêm User</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form id="addUserForm" class="form-horizontal">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Tên</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" placeholder="Nhập họ tên" required>
                    @if ($errors->has('name'))
                        <span class="text-danger error" id="errName">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" placeholder="Email" required>
                    @error('email')
                        )
                        <span class="text-danger" id="errEmail">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu"
                        required>
                    @if ($errors->has('password'))
                        <span class="text-danger" id="errPassword">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Xác nhận</label>
                    <input type="password" class="form-control" id="password_confirm" name="password_confirm" required
                        placeholder="Xác nhận mật khẩu">
                    @if ($errors->has('password_confirm'))
                        <span class="text-danger"
                            id="errPasswordConfirm">{{ $errors->first('password_confirm') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Nhóm</label>
                    {!! Form::select('group_role', [1 => 'Admin', 2 => 'Editor', 3 => 'Reviewer'], null, [
                        'class' => 'form-control',
                        'id' => 'selGroupRole',
                        'name' => 'selGroupRole',
                    ]) !!}
                </div>

                <div class="form-group">
                    <label class="">Trạng thái</label>
                    <input type="checkbox" checked data-toggle="toggle" data-onstyle="success" data-offstyle="secondary"
                        id="checkActive" name="checkActive" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="closePopup" name="closePopup" class="btn btn-secondary"
                    data-dismiss="modal">Hủy</button>
                <button id="addUserButton" name="addUserButton" type="submit"
                    class="btn btn-danger addUserButton">Lưu</button>
            </div>
        </form>
    </div>
</div>
