<template>
    <div id="feedback-button-container" @click="open()">
        <div id="feedback-button">
        
            <span class="glyphicon glyphicon-comment" />&nbsp;Vos impressions</a>

        </div>
    </div>
</template>

<script>
import Bus from '../events/Bus';

export default {
    data() {
        return {
            data: {}
        }
    },

    methods: {
        open() {
            Bus.$emit('set-modal-data', this.data, 'Vos impressions', 'feedback-modal');
            console.log('feedback clicked', Bus);
            Bus.$emit('open-modal');
        }
    }
}
</script>