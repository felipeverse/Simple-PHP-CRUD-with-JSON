<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this user?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form class="formDeleteUser" method="POST" action="delete.php">
                    <input type="hidden" name="id" id="id" value="">
                    <button class="mx-1 btn btn-outline-danger">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal script -->
<script type="text/javascript">
    $(function () {
        $(".deleteModalButton").click(function () {
            var my_id_value = $(this).data('id');
            console.log(my_id_value);
            $(".formDeleteUser #id").val(my_id_value);
        })
    });
</script>