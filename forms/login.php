<style>
.background {
    width: 430px;
    height: 520px;
    position: absolute;
    transform: translate(-50%, -50%);
    left: 50%;
    top: 50%;
}

.background .shape {
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
}

.shape:first-child {
    background: linear-gradient(#1845ad, #23a2f6);
    left: -80px;
    top: -80px;
}

.shape:last-child {
    background: linear-gradient(to right, #ff512f, #f09819);
    right: -30px;
    bottom: -80px;
}

.modal-content {
    background-color: rgba(255, 255, 255, 0.13);
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
    padding: 40px;
    position: relative;
}

.modal-header h5 {
    font-family: 'Poppins', sans-serif;
    font-size: 32px;
    font-weight: 500;
    color: #ffffff;
    text-align: center;
}

.modal-body label {
    color: #ffffff;
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    font-size: 16px;
}

.modal-body input {
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgba(255, 255, 255, 0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    color: #ffffff;
}

.modal-body input::placeholder {
    color: #e5e5e5;
}

.modal-footer button,
.modal-body button {
    width: 100%;
    background-color: #ffffff;
    color: #080710;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
    border: none;
}

.modal-body p {
    color: #ffffff;
    text-align: center;
}

.modal-body p a {
    color: #23a2f6;
    text-decoration: underline;
}
</style>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header d-flex">
        <h5 class="modal-title" id="loginModal">Login Here</h5>
        <button style="margin-left:190px; border:none;" type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="partials/user.php" method="post">
          <div class="text-left my-2">
            <label for="username">Username</label>
            <input class="form-control" id="loginusername" name="username" placeholder="Enter Your Username" type="text" required>
          </div>
          <div class="text-left my-2">
            <label for="password">Password</label>
            <input class="form-control" id="loginpassword" name="password" placeholder="Enter Your Password" type="password" required>
          </div>
          <button type="submit" name="login" lclass="btn btn-success">Submit</button>
        </form>
        <p class="mb-0 mt-1">Don't have an account? <a href="#" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#signupModal">Sign up now</a>.</p>
      </div>
    </div>
  </div>
</div>
