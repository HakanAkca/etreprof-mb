<template>
    <div class="modal fade" v-show="active" @click.self="close" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{title}}</h4>
                </div>

                <div class="modal-body">
                    <component :is="component" :data="data"></component>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import Bus from '../events/Bus';
import ExampleModalBody from './ExampleModalBody.vue';

export default {
    data() {
        return {
            active: false,
            data: {},
            title: null,
            component : null
        }
    },

    components: {
        ExampleModalBody
    },

    destroyed() {
        Bus.$off('set-modal-data', this.set);
        Bus.$off('open-modal', this.open);
    },

    methods: {
        close() {
            this.active = false;
        },

        open() {
            this.active = true;
            console.log(this.$el);
            $(this.$el).modal('show');
        },

        set(data, title, component) {
            //console.log('Modal.set', title);
            this.data = data;
            this.title = title;
            this.component = component;
            //this.id = this.component;
        }
    },

    mounted() {
        console.log('Modal.mounted');
        this.$nextTick(function () {
            Bus.$on('set-modal-data', this.set);
            Bus.$on('open-modal', this.open);
        }.bind(this));
    }
}
</script>