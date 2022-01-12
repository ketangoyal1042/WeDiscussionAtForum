    <!-- signup Modal -->
    <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signupModalLabel">Please Enter Your details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="partials/_handlesignup.php">
                <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleInputName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="exampleInputName" name="user_name"
                                aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" name="user_email"
                                aria-describedby="emailHelp" required>
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" name="user_pass" id="exampleInputPassword1"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPasswordCon" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="user_passcon" id="exampleInputPasswordCon"
                                required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="submit" value="sign-up">Sign Up</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- signup modal ends here -->
    