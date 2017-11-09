@push('scripts')

<script>
    var title = $('title').text();
    var discussionId = {{ $discussion_id or 'null' }};
    var discussions = [];
    var from = null;
    var userId = {{ Auth::user()->id }};

    var vuechat = new Vue({
        el: '#vuechat',
        data: {
            discussionId: discussionId,
            discussions: discussions,
            unread: {},
            messages: [],
            message: '',
            visible: 0
        },

        created: function () {
            this.update();
            var that = this;
            // Réception d'un message d'update depuis le socket
            bus.$on('discussion.message', function (data) {
                console.log('bus data', data);
                if (data.message) {
                    that.update();
                    var audio = new Audio('/sound/your-turn.mp3');
                    audio.play();
                }
            });
            bus.$on('discussion.demarrer', function (user) {
                //console.log(user);
                $.post('/discussions/demarrer', {
                    'user_id': user.id,
                    '_token': $('input[name="_token"]').val()
                })
                    .done(function (json) {
                        console.log(json);
                        that.discussionId = json.discussion_id;
                        that.visible = 1;
                        that.update();
                    })
            })
        },

        updated: function () {
            this.bottom();
        },

        methods: {
            setData: function (data) {
                if (data.discussions) {
                    this.discussions = data.discussions;
                    if (!this.discussionId) this.discussionId = data.discussions[0].id;
                }
                this.messages = data.messages;
                this.updateTitle();
                from = null;
            },
            updateTitle: function () {
                var unread = 0;
                this.discussions.map(function (d) {
                    unread += d.nonlus;
                    return d;
                });
                var prefix = (unread) ? '(' + unread + ') ' : '';
                $('title').text(prefix + title);
            },
            update: function () {
                var that = this;
                $.get('/discussions/' + this.discussionId + '.json')
                    .done(function (json) {
                        that.setData(json);

                        //that.bottom();
                    });
            },
            from: function (messagefrom) {
                if (from != messagefrom) {
                    from = messagefrom;
                    return messagefrom;
                }
            },
            send: function () {
                console.log(this.message);
                if (!this.message) return;
                var that = this;
                $.post('/discussions/' + this.discussionId, {message: this.message})
                    .done(function (json) {
                        that.message = '';
                        that.setData(json);
                    });
            },
            markdown: function (message) {
                return marked(message, {sanitize: true})
            },
            bottom: function () {
                //document.getElementById('msginput').scrollIntoView();
                $('.discussion .scrollable').scrollTop($('.discussion .innerscrollable').height());
            },
            setDiscussion: function (id) {
                this.discussionId = id;
                this.update();
            },
            addUnread: function (id) {
                this.unread[id] = (typeof(this.unread[id]) == 'number') ? val++ : 1;
            },
            nonlus: function (id) {
                return this.unread[id];
            },
            afficher: function () {
                this.visible = 1;
            },
            masquer: function () {
                this.visible = 0;
            },
            affichage: function () {
                return (this.visible) ? this.masquer() : this.afficher();
            }
        }

    });

    $(function () {
        $(window).resize(function () {
            var el = $('.fenetre-chat .scrollable');
            if (el.length) {
                console.log('fenetre', el);
                el.height($(window).innerHeight() - el.offset().top - $('#write').outerHeight());
            } else {

                var el = $('#popup-chat .scrollable');
                console.log('popup', el, $(window).innerHeight(), '-', $('#popup-chat .scrollable').offset().top, '-', $('#write').outerHeight());
                //el.height($(window).innerHeight() - el.offset().top - $('#write').outerHeight());
                el.maxHeight($(window).innerHeight() * 0.8 - $('#write').outerHeight());
            }
        }).resize();
    });

</script>
<script src="https://js.pusher.com/4.0/pusher.min.js"></script>
<script>

    var pusherKey = '{{ env('PUSHER_KEY') }}';

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher(pusherKey, {
        cluster: 'eu',
        encrypted: true
    });

    var channel = pusher.subscribe('private-discussion.' + userId);
    channel.bind('discussion.message', function (data) {
        console.log(data);
        bus.$emit('discussion.message', data)
        //alert(data.message);
    });
</script>
@endpush