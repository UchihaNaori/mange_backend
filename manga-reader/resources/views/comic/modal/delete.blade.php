<!-- Modal -->
<div class="modal fade" id="comic{{ $comic->id }}" tabindex="-1" role="dialog" aria-labelledby="deletecomicLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form>
                @csrf
                {!! method_field('DELETE') !!}
                <div class="modal-header">
                    <h5 class="modal-title" id="deletecomicLabel">Delete comic</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <p class="mb-3">
                            Do you want to delete this comic ?
                        </p>
                    </div>
                </div>
                <div class="modal-footer custom">
                    <div class="left-side">
                        <button type="button" class="btn btn-link danger" data-dismiss="modal">Cancel</button>
                    </div>
                    <div class="divider"></div>
                    <div class="right-side">
                        <button type="button" class="btn btn-link success delete" data-targer="#comic{{ $comic->id }}"
                                data-href="{{ route('comic.delete', $comic->id) }}">Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /End Modal -->
