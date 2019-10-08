@extends(Config::get('chatter.master_file_extend'))

@section(Config::get('chatter.yields.head'))
    <link href="{{ url('/vendor/devdojo/chatter/assets/vendor/spectrum/spectrum.css') }}" rel="stylesheet">
    <link href="{{ url('/vendor/devdojo/chatter/assets/css/chatter.css') }}" rel="stylesheet">
    @if($chatter_editor == 'simplemde')
        <link href="{{ url('/vendor/devdojo/chatter/assets/css/simplemde.min.css') }}" rel="stylesheet">
    @elseif($chatter_editor == 'trumbowyg')
        <link href="{{ url('/vendor/devdojo/chatter/assets/vendor/trumbowyg/ui/trumbowyg.css') }}" rel="stylesheet">
        <style>
            .trumbowyg-box, .trumbowyg-editor {
                margin: 0px auto;
            }
            #new_discussion_btn {
                display: block;
            }
            div.chatter_avatar span.chatter_avatar_circle {
                width: 60px;
                height: 60px;
                line-height: 62px;
                text-align: center;
                background: #263238;
                display: inline-block;
                border-radius: 30px;
                color: #fff;
                font-size: 20px;
            }
            .btn-new-discussion {
                display: block;
            }
            .m-b-30 {
                margin-bottom: 30px !important;
            }
        </style>
    @endif
@stop

@section('content')

    @if(config('chatter.errors'))
        @if(Session::has('chatter_alert'))
            <div class="chatter-alert alert alert-{{ Session::get('chatter_alert_type') }}">
                <div class="container">
                    <strong><i class="chatter-alert-{{ Session::get('chatter_alert_type') }}"></i> {{ Config::get('chatter.alert_messages.' . Session::get('chatter_alert_type')) }}</strong>
                    {{ Session::get('chatter_alert') }}
                    <i class="chatter-close"></i>
                </div>
            </div>
            <div class="chatter-alert-spacer"></div>
        @endif

        @if (count($errors) > 0)
            <div class="chatter-alert alert alert-danger">
                <div class="container">
                    <p><strong><i class="chatter-alert-danger"></i> @lang('chatter::alert.danger.title')</strong> @lang('chatter::alert.danger.reason.errors')</p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    @endif

    <div class="row">
        <div class="col-sm-3">
            <div class="well">
                <button class="btn bg-color-blueDark txt-color-white btn-new-discussion" id="new_discussion_btn" style="display: block; margin-bottom: 20px"><i class="chatter-new"></i> @lang('chatter::messages.discussion.new')</button>
                <div style="margin-bottom: 10px">
                    <a class="btn btn-labeled btn-default btn-block" href="{{URL::to('/')}}/{{ Config::get('chatter.routes.home') }}"> @lang('chatter::messages.discussion.all')</a>
                </div>

                <!-- SIDEBAR -->
                <div class="chatter_sidebar">
                    <ul class="nav nav-pills nav-stacked">
                        {!! $categoriesMenu !!}
                    </ul>
                </div>
                <!-- END SIDEBAR -->
            </div>
        </div>
        <div class="col-sm-9">

            <div class="well">

                <table class="table table-striped table-forum">
                    <thead>
                    <tr>
                        <th colspan="2">{{Lang::get('Temas')}}</th>
                        <th>{{Lang::get('Categoría')}}</th>
                        <th class="text-center hidden-xs hidden-sm" style="width: 100px;">{{Lang::get('Mensajes')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (sizeof($discussions) == 0)
                        <tr>
                            <td colspan="4">{{Lang::get('No hay temas en esta categoría')}}</td>
                        </tr>
                    @endif
                    @foreach($discussions as $discussion)
                        <!-- TR -->
                        <tr>
                            <td>
                                <div class="chatter_avatar">
                                @if(Config::get('chatter.user.avatar_image_database_field'))

                                    <?php $db_field = Config::get('chatter.user.avatar_image_database_field'); ?>

                                    <!-- If the user db field contains http:// or https:// we don't need to use the relative path to the image assets -->
                                        @if( (substr($discussion->user->{$db_field}, 0, 7) == 'http://') || (substr($discussion->user->{$db_field}, 0, 8) == 'https://') )
                                            <img src="{{ $discussion->user->{$db_field}  }}">
                                        @else
                                            <img src="{{ Config::get('chatter.user.relative_url_to_image_assets') . $discussion->user->{$db_field}  }}">
                                        @endif

                                    @else

                                        <img src="{{URL::to('img/avatars/male.png')}}" alt="me" class="online" />

                                    @endif
                                </div>
                            </td>
                            <td>
                                <h4><a href="{{URL::to('/')}}/{{ Config::get('chatter.routes.home') }}/{{ Config::get('chatter.routes.discussion') }}/{{ $discussion->category->slug }}/{{ $discussion->slug }}">
                                        {{ $discussion->title }}
                                    </a>
                                    <small>
                                        <span class="chatter_middle_details">@lang('chatter::messages.discussion.posted_by') <span data-href="{{URL::to('/')}}/user">{{ ucfirst($discussion->user->{Config::get('chatter.user.database_field_with_user_name')}) }}</span> {{ \Carbon\Carbon::createFromTimeStamp(strtotime($discussion->created_at))->diffForHumans() }}</span>
                                        @if($discussion->post[0]->markdown)
                                            <?php $discussion_body = GrahamCampbell\Markdown\Facades\Markdown::convertToHtml( $discussion->post[0]->body ); ?>
                                        @else
                                            <?php $discussion_body = $discussion->post[0]->body; ?>
                                        @endif
                                        <p>{{ substr(strip_tags($discussion_body), 0, 200) }}@if(strlen(strip_tags($discussion_body)) > 200){{ '...' }}@endif</p>
                                    </small>

                                </h4>
                            </td>
                            <td class="chatter_middle_title">
                                <a class="btn btn-info btn-xs" style="background-color:{{ $discussion->category->color }}" href="{{URL::to('/')}}/{{config('chatter.routes.home')}}/{{config('chatter.routes.category')}}/{{$discussion->category->slug}}">{{ $discussion->category->name }}</a>
                            </td>
                            <td class="text-center">
                                <div class="chatter_right">
                                    <div class="chatter_count"><i class="chatter-bubble"></i> {{ $discussion->postsCount[0]->total }}</div>
                                </div>
                            </td>
                        </tr>
                        <!-- end TR -->
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div id="pagination">
        {{ $discussions->links() }}
    </div>

    <div id="chatter" class="chatter_home">
        <div id="new_discussion">
            <div class="chatter_loader dark" id="new_discussion_loader">
                <div></div>
            </div>
            <form id="chatter_form_editor" action="{{URL::to('/')}}/{{ Config::get('chatter.routes.home') }}/{{ Config::get('chatter.routes.discussion') }}" method="POST">
                <div class="row">
                    <div class="col-md-7">
                        <!-- TITLE -->
                        <input type="text" class="form-control" id="title" name="title" placeholder="@lang('chatter::messages.editor.title')" value="{{ old('title') }}" >
                    </div>

                    <div class="col-md-4">
                        <!-- CATEGORY -->
                        <select id="chatter_category_id" class="form-control" name="chatter_category_id">
                            <option value="">@lang('chatter::messages.editor.select')</option>
                            @foreach($categories as $category)
                                @if(old('chatter_category_id') == $category->id)
                                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                @elseif(!empty($current_category_id) && $current_category_id == $category->id)
                                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                @else
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-1">
                        <i class="chatter-close"></i>
                    </div>
                </div><!-- .row -->

                <!-- BODY -->
                <div id="editor">
                    @if( $chatter_editor == 'tinymce' || empty($chatter_editor) )
                        <label id="tinymce_placeholder">@lang('chatter::messages.editor.tinymce_placeholder')</label>
                        <textarea id="body" class="richText" name="body" placeholder="">{{ old('body') }}</textarea>
                    @elseif($chatter_editor == 'simplemde')
                        <textarea id="simplemde" name="body" placeholder="">{{ old('body') }}</textarea>
                    @elseif($chatter_editor == 'trumbowyg')
                        <textarea class="trumbowyg" name="body" placeholder="@lang('chatter::messages.editor.tinymce_placeholder')">{{ old('body') }}</textarea>
                    @endif
                </div>

                <input type="hidden" name="_token" id="csrf_token_field" value="{{ csrf_token() }}">

                <div id="new_discussion_footer">
                    <input type='text' id="color" name="color" /><span class="select_color_text">@lang('chatter::messages.editor.select_color_text')</span>
                    <button id="submit_discussion" class="btn btn-success pull-right"><i class="chatter-new"></i> @lang('chatter::messages.discussion.create')</button>
                    <a href="{{URL::to('/')}}/{{ Config::get('chatter.routes.home') }}" class="btn btn-default pull-right" id="cancel_discussion">@lang('chatter::messages.words.cancel')</a>
                    <div style="clear:both"></div>
                </div>
            </form>

        </div><!-- #new_discussion -->

    </div>

    @if( $chatter_editor == 'tinymce' || empty($chatter_editor) )
        <input type="hidden" id="chatter_tinymce_toolbar" value="{{ Config::get('chatter.tinymce.toolbar') }}">
        <input type="hidden" id="chatter_tinymce_plugins" value="{{ Config::get('chatter.tinymce.plugins') }}">
    @endif
    <input type="hidden" id="current_path" value="{{ Request::path() }}">

@endsection

@section(Config::get('chatter.yields.footer'))


    @if( $chatter_editor == 'tinymce' || empty($chatter_editor) )
        <script>
            var url = "{{URL::to('/')}}";
        </script>
        <script src="{{ url('/vendor/devdojo/chatter/assets/vendor/tinymce/tinymce.min.js') }}"></script>
        <script src="{{ url('/vendor/devdojo/chatter/assets/js/tinymce.js') }}"></script>
        <script>
            var my_tinymce = tinyMCE;
            $('document').ready(function(){
                $('#tinymce_placeholder').click(function(){
                    my_tinymce.activeEditor.focus();
                });
            });
        </script>
    @elseif($chatter_editor == 'simplemde')
        <script src="{{ url('/vendor/devdojo/chatter/assets/js/simplemde.min.js') }}"></script>
        <script src="{{ url('/vendor/devdojo/chatter/assets/js/chatter_simplemde.js') }}"></script>
    @elseif($chatter_editor == 'trumbowyg')
        <script src="{{ url('/vendor/devdojo/chatter/assets/vendor/trumbowyg/trumbowyg.min.js') }}"></script>
        <script src="{{ url('/vendor/devdojo/chatter/assets/vendor/trumbowyg/plugins/preformatted/trumbowyg.preformatted.min.js') }}"></script>
        <script src="{{ url('/vendor/devdojo/chatter/assets/js/trumbowyg.js') }}"></script>
    @endif

    <script src="{{ url('/vendor/devdojo/chatter/assets/vendor/spectrum/spectrum.js') }}"></script>
    <script src="{{ url('/vendor/devdojo/chatter/assets/js/chatter.js') }}"></script>
    <script>
        $('document').ready(function(){
            $('.chatter-close, #cancel_discussion').click(function(){
                $('#new_discussion').slideUp();
            });
            $('#new_discussion_btn').click(function(){
                @if(Auth::guest())
                    window.location.href = "{{ route('login') }}";
                @else
$('#new_discussion').slideDown();
                $('#title').focus();
                @endif
            });
            $("#color").spectrum({
                color: "#333639",
                preferredFormat: "hex",
                containerClassName: 'chatter-color-picker',
                cancelText: '',
                chooseText: 'close',
                move: function(color) {
                    $("#color").val(color.toHexString());
                }
            });
            @if (count($errors) > 0)
$('#new_discussion').slideDown();
            $('#title').focus();
            @endif
        });
    </script>
@stop