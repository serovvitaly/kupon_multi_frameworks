<!-- Modal -->
<div class="modal" id="postModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div id="modalPostHeader">
          <img class="ribbon-icon" alt="64x64" src="">
          <strong style="padding-left: 5px;"></strong>
        </div>
      </div>
      <div class="modal-body" id="modalPostContent">
        ...
      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>

<script>
    function showModal(postId) {
        history.pushState({'page_id': postId}, '', '/post/'+postId+'/');
        $.getJSON('/ajax/post/'+postId+'/?from=index', function(response){
            $('#modalPostContent').html(response.html);
            $('#modalPostHeader>img').attr('src', response.ribbon_icon);
            $('#modalPostHeader>strong').html(response.ribbon_title);
        });
        $('#postModal').modal('show');
        return false;
    }
    $(function () {
        $('#postModal').on('hide.bs.modal', function (e) {
            history.pushState({'page_id': 0}, '', '/');
            $('#modalPostContent').html('');
            $('#modalPostHeader>img').attr('src', '');
            $('#modalPostHeader>strong').html('');
        });
        @if(isset($article_id))
        showModal({{ $article_id }});
        @endif
    });
</script>