<style>
    #popup-contacts {
        background-color: rebeccapurple;
        border-bottom-left-radius: 2px;
        border-top-left-radius: 2px;
        color: #fff;
        cursor: pointer;
        display: block;
        position: fixed;
        right: 0;
        text-decoration: none;
        bottom: 0;
        z-index: 1000;
    }

</style>

<div id="discussion-vue">
    <div id="popup-contacts">
        <h3 @click="affichage()">&nbsp Discussion instantanée <span v-if="visible">X</span></h3>
        <div v-if="visible"><h4 class="text-center">Liste des contact</h4>
            <div v-for="contact in contacts">
                <a class="btn btn-primary btn-block" @click="discussion(contact)">@{{ contact.name }}</a>
            </div>
        </div>
    </div>
</div>

<script>

    var vuemembre = new Vue({
        el: '#discussion-vue',
        data: {
            visible: 0,
            contacts: []
        },
        methods: {
            afficher: function () {
                var that = this;
                $.get('/membres/liste-contacts.json')
                    .done(function (json) {
                        that.visible = 1;
                        that.contacts = json.contacts;
                    })
            },
            masquer: function () {
                this.visible = 0;
            },
            affichage: function () {
                return (this.visible) ? this.masquer() : this.afficher();
            },
            discussion: function (user) {
                bus.$emit('discussion.demarrer', user);
                //console.log(user);
                this.visible = 0;
            }
        }
    })
</script>