   <!--login Modal -->
   <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="loginModalLabel">Enter Details to Login</h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <form method="POST" action="partials/_handlelogin.php">
               <div class="modal-body">
                       <div class="mb-3">
                           <label for="exampleInputEmail1" class="form-label">Email address</label>
                           <input type="email" class="form-control" name="InputEmail" required id="exampleInputEmail1"
                               aria-describedby="emailHelp">
                           <div id="emailHelp" class="form-text">Please provide correct Email Id</div>
                       </div>
                       <div class="mb-3">
                           <label for="exampleInputPassword1" required class="form-label">Password</label>
                           <input type="password" class="form-control" name="InputPassword" id="exampleInputPassword1">
                       </div>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                   <button type="submit" class="btn btn-primary" name="submit" value="log-in">Login</button>
               </div>
               </form>
           </div>
       </div>
   </div>