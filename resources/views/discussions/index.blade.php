@extends ('layout')

@section('content')

    <div id="vuechat" class="fenetre-chat">

        <div class="row" id="discussion-container">

            <div class="col-sm-4">

                <div class="list-group">

                    <a v-for="discussion in discussions" href="#" @click="setDiscussion(discussion.id)"
                       class="list-group-item" :class="{ 'active' : discussion.id == discussionId }">
                        <span class="badge">@{{ discussion.updated_at | ago }}</span>
                        <span class="badge badge-danger">@{{ discussion.nonlus > 0 ? discussion.nonlus : '' }}</span>
                        <h4>
                            <div class="thumb pull-left"
                                 :style="{ backgroundImage : 'url(' + discussion.image + ')'}"></div>@{{ discussion.other }}
                        </h4>

                        <small v-if="discussion.lastmessage">@{{ discussion.lastmessage.message | truncate(50) }}</small>
                    </a>

                </div>
            </div>
            <div class="col-sm-8 discussion">
                <div class="scrollable">
                    <div class="innerscrollable">
                        <div v-for="message in messages" class="ligne"
                             :class="{ 'left' : message.name != 'Moi', 'right' : message.name == 'Moi'}">

                            <div class="from">
                                <span v-if="from(message.name)"><div class="thumb"
                                                                     :style="{ backgroundImage : 'url(' + message.image + ')'}"></div><span
                                            v-if="0">@{{ message.name }}</span></span>
                                <span v-if="!from(message.name)">&nbsp;</span>
                            </div>

                            <div class="bulle" v-html="markdown(message.message)"></div>

                            <div class="date">
                                @{{ message.created_at | ago}}
                            </div>
                        </div>
                        <div class="clearBoth"></div>
                    </div><!-- .innerscrollable -->
                </div><!-- .scrollable -->

                <div class="form-horizontal no-gutter clearfix" id="write">
                    <div class="form-group">
                        <div class="col-xs-10">
                            <input type="text" placeholder="Ecrivez..." class="form-control" v-model="message"
                                   id="msginput" @keyup.13="send()">
                        </div>
                        <div class="col-xs-2">
                            <input type="button" v-on:click="send()" value="Envoyer" class="btn btn-block btn-primary">
                        </div>
                    </div>
                </div><!-- #write -->
            </div><!-- .discussion -->

        </div>

    </div><!-- #vuechat -->

    @include('discussions.script')

@endsection
