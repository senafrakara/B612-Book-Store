<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Reset your password</h4>
            </div>
            <div class="modal-body">
                <form id="resetPassword" name="resetPassword" method="post" action="<?= base_url(); ?>users/ForgotPassword" onsubmit='return validate()'>
                    <table class="table table-bordered table-hover table-striped">
                        <tbody>
                            <tr>
                                <td>Enter Email: </td>
                                <td>
                                    <input type="email" name="email" id="email" style="width:250px" required>
                                </td>
                                <td><input type="submit" value="submit" class="button"></td>
                            </tr>

                        </tbody>
                    </table>
                </form>
                <div id="fade" class="black_overlay"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>