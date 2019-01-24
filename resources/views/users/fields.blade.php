<div class="row clearfix">
  <div class="col-sm-6">
    <div class="form-group required">
      <label class="control-label">Name</label>
      <div class="form-line">
        {!! Form::text('name', null, array('placeholder' => 'John Doe','class' => 'form-control')) !!}
      </div>
      <span class="help-block"></span>
    </div>
  </div>
</div>
<div class="row clearfix">
  <div class="col-sm-6">
    <div class="form-group required">
      <label class="control-label">Login ID</label>
      <div class="form-line">
        {!! Form::text('username', null, array('placeholder' => 'Login ID','class' => 'form-control')) !!}
      </div>
      <span class="help-block"></span>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <label class="control-label">Email</label>
      <div class="form-line">
        {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
      </div>
      <span class="help-block"></span>
    </div>
  </div>
</div>
<div class="row clearfix">
  <div class="col-sm-6">
    <div class="form-group required">
      <label class="control-label">Password</label>
      <div class="form-line">
        {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
      </div>
      <span class="help-block"></span>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group required">
      <label class="control-label">Confirm Password</label>
      <div class="form-line">
        {!! Form::password('confirm_password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
      </div>
      <span class="help-block"></span>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <label class="control-label">Mobile Number</label>
      <div class="form-line">
        {!! Form::text('mobile',null,array('placeholder' => 'Mobile Number','class' => 'form-control','maxlength'=> '11')) !!}
      </div>
      <span class="help-block"></span>
    </div>
  </div>

  <div class="col-sm-6">
    <div class="form-group">
      <label class="control-label">Address</label>
      <div class="form-line">
        {!! Form::text('address',null,array('placeholder' => 'Address','class' => 'form-control')) !!}
      </div>
      <span class="help-block"></span>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <label class="control-label">ID/S-ID</label>
      <div class="form-line">
        {!! Form::text('id_number',null,array('placeholder' => 'ID/S-ID','class' => 'form-control')) !!}
      </div>
      <span class="help-block"></span>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <label class="control-label">Secondary Contact</label>
      <div class="form-line">
        {!! Form::text('secondary_contact',null,array('placeholder' => 'Secondary Contact','class' => 'form-control')) !!}
      </div>
      <span class="help-block"></span>
    </div>
  </div>
</div>

<div class="row clearfix">
  <div class="col-md-4">
    <label for="category">Is Active</label>
    <div class="form-group">
      <div class="demo-checkbox">
        {!! Form::checkbox('is_active', true, empty($user) ? true : $user->is_active, ['class' => 'filled-in', 'id' => 'is_active']) !!}
        <label for="is_active">Is Active</label>
      </div>
    </div>
    <span class="help-block"></span>
  </div>
  <div class="col-md-4">
    <label for="">Is Locked</label>
    <div class="form-group">
      <div class="demo-checkbox">
        {!! Form::checkbox('is_locked', true, empty($user) ? false : $user->is_locked, ['class' => 'filled-in', 'id' => 'is_locked']) !!}
        <label for="is_locked">Is Locked</label>
      </div>
    </div>
    <span class="help-block"></span>
  </div>
  <div class="col-md-4">
    <label for="">User Type</label>
    <div class="form-group">
      <div class="demo-radio">
        {!! Form::radio('role_id', "1", empty($user) ? false : $user->hasRole('admin'), ['class' => 'filled-in', 'id' => 'is_admin1']) !!}
        <label for="is_admin1">Admin</label>
        {!! Form::radio('role_id', "2", empty($user) ? true : $user->hasRole('trainer'), ['class' => 'filled-in', 'id' => 'is_admin2']) !!}
        <label for="is_admin2">Trainer</label>
      </div>
    </div>
    <span class="help-block"></span>
  </div>
</div>
