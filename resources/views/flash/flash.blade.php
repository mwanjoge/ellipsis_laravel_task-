@if(session()->has("flash_message"))
<div class="alert alert-{{session("flash_message_level")}} alert-dismissible fade show py-1" role="alert">
     {{session("flash_message")}}
    <button type="button" class="btn-close py-1" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
