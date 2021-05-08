<div>
    <div class="meme-base">
        @forelse($memes as $meme)
            <div class="row meme-container">
                <meme-component :meme="{{ $meme }}"
                                memeimage="{{ $meme->sourceImage }}"
                                :user='@json(auth()->user())'
                                single_meme_route="{{ route('meme.single', $meme->id) }}"
                                user_route="{{ route('user.show', $meme->user_id) }}"
                                delete_meme_route="{{ route('meme.delete') }}"
                                edit_meme_route="{{route('meme.edit',$meme->id)}}"
                                show_memes_category_route="{{route('filter.category', $meme->category_id)}}">
                </meme-component>
                <div class="row right-side">
                    @if(!auth()->guest())
                        <div class="row report-meme">
                            <button type="button"
                                    id="report_meme_button"
                                    class="btn"
                                    onclick="ReportMeme({{ $meme->id }});">
                                Report Meme
                            </button>
                        </div>
                    @else
                        <div class="row report-meme">
                            <button type="button"
                                    id="report_meme_button"
                                    class="btn"
                                    onclick="ReportMeme({{ $meme->id }});"
                                    disabled>
                                Report Meme
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            @include('partials.memes-not-found')
        @endforelse
    </div>
    <div class="centered-element">
        @include('pagination.default_pagination', ['paginator' => $memes])
    </div>
</div>
