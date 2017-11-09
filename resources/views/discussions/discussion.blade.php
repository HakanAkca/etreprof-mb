<style>
    #popup-chat {
        background-color: rebeccapurple;
        border-bottom-left-radius: 2px;
        border-top-left-radius: 2px;
        color: #fff;
        cursor: pointer;
        display: block;
        position: fixed;
        left: 0;
        width: 350px;
        text-decoration: none;
        bottom: 0;
        z-index: 1000;
    }
</style>

<div id="vuechat">
    <div id="popup-chat">
        <h3 @click="affichage()">Discussion en cours <span style="float: right;" v-if="visible">X</span></h3>

        <div id="discussion-container">
            <div class="col-sm-12 discussion">
                <div v-show="visible" class="scrollable">
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
                            <input type="button" v-on:click="send()" value="Envoyer"
                                   class="btn btn-block btn-primary">
                        </div>
                    </div>
                </div><!-- #write -->
            </div><!-- .discussion -->
        </div>
    </div>
</div>


@include('discussions.script')


