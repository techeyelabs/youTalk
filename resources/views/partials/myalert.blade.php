<div class="row">
    <div class="col-md-12 alert alert-dismissable {{ session('message')['status'] ? 'alert-success' : 'alert-danger' }}">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ session('message')['text'] }}
    </div>
</div>