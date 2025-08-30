<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Management CRUD</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>



<div class="container mt-5">
  <h2>User Management</h2>

  <div class="row mb-3">
    <div class="col-md-6">
      <input type="text" id="search" class="form-control" placeholder="Live Search...">
    </div>
    
    <div class="col-md-6 text-end">
      <button class="btn btn-primary" id="btnAdd">Add User</button>
    </div>
  </div>

  <div id="userTable"></div>
</div>

<!-- Add/Edit Modal -->
<div class="modal fade" id="userModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="userForm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="userId">
          <div class="mb-3"><label>First Name</label><input type="text" name="firstname" class="form-control" required></div>
          <div class="mb-3"><label>Last Name</label><input type="text" name="lastname" class="form-control" required></div>
          <div class="mb-3"><label>Email</label><input type="email" name="emailaddress" class="form-control" required></div>
          <div class="mb-3"><label>Password</label><input type="password" name="password" class="form-control" required></div>
          <div class="mb-3"><label>Phone</label><input type="text" name="phone" class="form-control"></div>
          <div class="mb-3"><label>City</label><input type="text" name="city" class="form-control"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success" id="saveBtn">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(function(){
  const userModal = new bootstrap.Modal($('#userModal'));

  function loadUsers(search='') {
    $.post('ajax.php', { action: 'read', search }, html => {
      $('#userTable').html(html);
    });
  }

  $('#search').on('keyup', function(){
    loadUsers($(this).val());
  });

  $('#btnAdd').click(function(){
    $('#userForm')[0].reset();
    $('#userId').val('');
    $('.modal-title').text('Add User');
    userModal.show();
  });

  $('#userForm').submit(function(e){
    e.preventDefault();
    const action = $('#userId').val() ? 'update' : 'create';
    $.post('ajax.php', $(this).serialize() + '&action=' + action, function(){
      userModal.hide();
      loadUsers();
    });
  });

  $(document).on('click', '.editBtn', function(){
    $.post('ajax.php', { action: 'get', id: $(this).data('id') }, data => {
      const user = JSON.parse(data);
      $('#userId').val(user.id);
      $('[name="firstname"]').val(user.firstname);
      $('[name="lastname"]').val(user.lastname);
      $('[name="emailaddress"]').val(user.emailaddress);
      $('[name="password"]').val(user.password);
      $('[name="phone"]').val(user.phone);
      $('[name="city"]').val(user.city);
      $('.modal-title').text('Edit User');
      userModal.show();
    });
  });

  $(document).on('click', '.deleteBtn', function(){
    if(confirm('Delete this user?')) {
      $.post('ajax.php', { action: 'delete', id: $(this).data('id') }, loadUsers);
    }
  });

  loadUsers();
});
</script>
</body>
</html>
