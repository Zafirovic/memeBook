<div class="container create-meme-container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row justify-content-center">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="radioBtn" id="selectMeme" name="chooseMemeType" value="1" checked>
                    <label style="font-size: 1.1rem" for="selectMeme"> Select meme </label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="radioBtn" id="uploadMeme" name="chooseMemeType" value="2">
                    <label style="font-size: 1.1rem" for="uploadMeme"> Upload meme </label>
                </div>
            </div>
            <form method="POST" id="meme-store" name="create-meme-form" action="{{ route('meme.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="wrapper-form">
                    <div class="preview-container">
                        <!-- Image canvas container -->
                        <canvas id="image-canvas" resize>
                            <div id="image-spinner"> 
                                <i class="spinner-border spinner-border fa-spin"></i> Loading images...
                            </div>
                        </canvas>
                        <!----> 
                        <!-- Upload meme container -->
                        <div class="form-group meme-upload-option" style="display: none">
                            <div class="file-upload">
                                <button class="file-upload-btn" type="button">Add Image</button>
                                <div class="image-upload-wrap">
                                    <input class="file-upload-input" type='file' accept="image/*" />
                                    <div class="drag-text">
                                        <h3>Drag and drop a file or select add Image</h3>
                                    </div>
                                </div>
                                <div class="file-upload-content">
                                    <div class="image-title-wrap">
                                        <button class="remove-image" type="button">
                                            Remove <span class="image-title">Uploaded Image</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @endif
                        </div>
                        <!---->
                    </div>
                    <div class="create-settings">
                        <div class="select-popular-meme-container">
                            <p class="text-center h4"> Select popular meme </p>
                            <p class="meme-title"></p>
                            <div id="slide">
                                @foreach ($apiMemeImages as $meme)
                                    <img class="image-option"
                                        src="{{ $meme['url'] }}"
                                        title="{{ $meme['name'] }}"
                                        crossorigin="anonymous">
                                @endforeach
                            </div>
                        </div>
                        <div class="input-container">
                            <div class="input-group form-group text-content">
                                <textarea
                                    name="user-text-input"
                                    class="text-input form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" 
                                    placeholder="Insert Text"
                                    required
                                    autofocus
                                    value="{{ old('title') }}">
                                </textarea>
                                <div class="dropdown input-group-append">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                                            <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                                            <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right text-options" style="width: 300px">
                                        <div class="dropdown-submenu text-options">
                                            <div>
                                                <label> Select text color </label>
                                                <input type="color" class="text-color">
                                            </div>
                                        </div>
                                        <div class="dropdown-submenu text-options">
                                            <div>
                                                <label> Font </label>
                                                <select class="fonts"></select>
                                            </div>
                                        </div>
                                        <div class="dropdown-submenu text-options">
                                            <div>
                                                <label for="fontSize"> Font size </label>
                                                <input type="number" class="fontSize" step="1" min="0">
                                            </div>
                                        </div>
                                        <div class="dropdown-submenu checkboxes text-options"> 
                                            <div>
                                                <label>
                                                    <input type="checkbox" class="fontShadow">
                                                    <span> Font shadow </span></input>
                                                </label>
                                            </div>                                        
                                        </div>
                                        <div class="dropdown-submenu text-options text-shadow-color" style="display: none;">
                                            <div>
                                                <label> Select shadow color </label>
                                                <input type="color" class="shadow-color">
                                            </div>
                                        </div>
                                    </div>
                                </div>                       
                                @if ($errors->has('title'))
                                    <div class="alert">
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    </div>  
                                @endif
                            </div>
                        </div>
                        <div>
                            <a id="add-new-text" href="#">
                                <span><i class="fas fa-plus"></i> Add new text </span>
                            </a>
                        </div>
                        <div class="category-container">
                            <div class="input-group form-group">
                                <div id="category-select">
                                    @if (!empty($categories))
                                        <label for="selectCategoryId"><b> Choose the category of your meme: </b></label>
                                        <select class="browser-default custom-select" name="category_id" id="selectCategoryId">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                            </div>
                            <br>
                        </div>
                        <div class="col text-center">
                            <button type="submit" id="btn-meme" class="btn btn-primary btn-block">
                                CREATE MEME
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
    <script type="module" type="text/javascript" crossorigin="anonymous" src="{{ asset('js/canvas/canvas.js') }}"></script>
    <script type="module" type="text/javascript" crossorigin="anonymous" src="{{ asset('js/meme/meme-generate.js') }}"></script>
    <script type="module" type="text/javascript" crossorigin="anonymous" src="{{ asset('js/fonts/fonts.js') }}"></script>
    <script type="module" type="text/javascript" crossorigin="anonymous" src="{{ asset('js/upload-files/file-input.js') }}"></script>
    <script type="module" type="text/javascript" crossorigin="anonymous" src="{{ asset('js/animations/animation.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jscolor/2.4.0/jscolor.min.js"></script>
@endsection
