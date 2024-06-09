<?php use function lib\stop;

stop(0, __FILE__);

$sud = config->signup_disabled;
$lid = config->login_disabled;

if ($sud) $signup = "disabled"; else $signup = "";

if ($lid) $login = "disabled"; else $login = "";
?>
<!-- Modal -->
<div class="show modal fade modal-dialog-centered" id="staticBackdrop" data-bs-backdrop="static"
     data-bs-keyboard="false"
     tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 50vw">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Account Required</h1>
            </div>
            <form>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="username" placeholder="name@example.com"
                               autocomplete="email">
                        <label for="username">Email address</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="password" placeholder="Password"
                               autocomplete="current-password">
                        <label for="password">Password</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary <?php echo $login; ?>">Log in</button>
                    <button type="button" class="btn btn-secondary <?php echo $signup; ?>">Sign up</button>
                </div>
            </form>
        </div>
    </div>
</div>
