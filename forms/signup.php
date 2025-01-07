<!-- Sign Up Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex">
                <h5 class="modal-title" id="signupModal">Sign Up Here</h5>
                <button type="button" style="border: none; margin-left:150px;" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="partials/user.php" method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input class="form-control" id="username" name="username" placeholder="Choose a unique Username"
                            type="text" required minlength="3" maxlength="11">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone No:</label>
                        <input type="tel" class="form-control" id="phone" name="phone"
                            placeholder="Enter Your Phone Number" required maxlength="10">
                    </div>
                    <div class="form-group">
                <label for="password">Password:</label>
                <input class="form-control" id="password" name="password" placeholder="Enter Password"
                    type="password" required minlength="4" maxlength="21">
            </div>
            <div class="text-left my-2">
                <label for="password">Password</label>
                <input class="form-control" id="loginpassword" name="cpassword" placeholder="Enter Your Password" type="password" required>
            </div>
            <button type="submit" name="signup" class="btn btn-success">Submit</button>
            </form>
            </div>
            <p class="mb-0 mt-1">Already have an account? <a href="#" data-dismiss="modal" data-bs-toggle="modal"
                    data-bs-target="#loginModal">Login here</a>.</p>
        </div>
    </div>
</div>
</div>